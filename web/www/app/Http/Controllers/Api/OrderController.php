<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\OrderRequest;
use App\Http\Services\OrderService;
use App\Mail\CustomerOrderMail;
use App\Mail\UserOrderMail;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\ShippingDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends ApiController
{
    /*
    |--------------------------------------------------------------------------
    | Order / POS API Controller
    |--------------------------------------------------------------------------
    |
    | @Description : Order / POS Manage
    | @Author : Tarek Monjur.
    | @Email  : tarekmonjur@gmail.com
    |
    */

    use OrderService;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:'.$this->guard, ['except' => ['store']]);
    }

    public function index(Request $request)
    {
        try {
            $this->setTitle()
                ->setFilters($request->all())
                ->getDataModel();
            return $this->jsonResponse($this->data, $this->data['title']);
        } catch (\Exception $e) {
            return $this->jsonResponse(null, $e->getMessage(), 'error', $e->getCode());
        }
    }

    public function show(Request $request)
    {
        try {
            if($this->guard === 'customer' && $this->authUser->getTable() === (new Customer)->getTable()) {
                $this->setFilter('customer_id', $this->authUser->id);
            }
            $this->setTitle('view')
                ->setIdSlug($request->id)
                ->setSubList($request->sublist)
                ->setColumns($request->columns)
                ->getDataModel();
            return $this->jsonResponse($this->data, $this->data['title']);
        } catch (\Exception $e) {
            return $this->jsonResponse(null, $e->getMessage(), 'error', $e->getCode());
        }
    }

    public function store(OrderRequest $request)
    {
        try {
            $order_result = $this->makeOrder($request);
            if (empty($order_result)) {
                return $this->jsonResponse(null, $this->getTrans('warning_msg'));
            }
            DB::beginTransaction();
            $order = new Order();
            $order->setRawAttributes($order_result);
            $order->offsetUnset('items');
            $order->offsetUnset('shipping_details');
            $order->created_by = $this->authUser && $this->authUser->getTable() === 'users' ? $this->authUser->id : 0;
            if ($order->save()) {
                $shipping = $this->upsertShippingDetails($order->id, $order_result['shipping_details']);
                $order->setAttribute('shipping_details', $shipping);
                $items = $order_result['items'];
                foreach($items as $key => $value) {
                    $items[$key]['order_id'] = $order->id;
                    $items[$key]['product_variant'] = !empty($value['product_variant']) && is_array($value['product_variant']) ?
                        json_encode($value['product_variant']) : null;
                    $items[$key]['product_stock'] = !empty($value['product_stock']) && is_array($value['product_stock']) ?
                        json_encode($value['product_stock']) : null;
                }
                $items = $order->orderDetails()->createMany($items);
                $order->setAttribute('items', $items);
                DB::commit();
                $context = $this->getContext();
                if ($order->source === 'online' && $context['settings']['send_order_email']) {
                    $order = Order::with(['orderDetails', 'shippingDetails', 'customer'])->find($order->id);
                    $to_email = $order->shippingDetails ? $order->shippingDetails->email : '';
                    if ($to_email) {
                        Mail::to($to_email)->send(new CustomerOrderMail($order));
                    }
                    Mail::to(config('mail.from.address'))->send(new UserOrderMail($order));
                }
                return $this->jsonResponse($order->getAttributes(), $this->getTrans('success_msg'));
            } else {
                DB::rollBack();
                return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
            }
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
        }
    }

    public function update(OrderRequest $request)
    {
        try {
            $order = Order::find($request->id);
            if (!$order) {
                return $this->jsonResponse(null, $this->getTrans('warning_msg'));
            }

            $order_result = $this->makeOrder($request);
            DB::beginTransaction();
            $order->setRawAttributes($order_result);
            $order->offsetUnset('items');
            $order->offsetUnset('shipping_details');
            $order->created_by = $this->authUser && $this->authUser->getTable() === 'users' ? $this->authUser->id : 0;
            if ($order->save()) {
                $shipping = $this->upsertShippingDetails($order->id, $order_result['shipping_details']);
                $order->setAttribute('shipping_details', $shipping);
                $items = [];
                $existing_items = [];
                foreach($order_result['items'] as $item) {
                    $item['product_variant'] = !empty($item['product_variant']) && is_array($item['product_variant']) ?
                        json_encode($item['product_variant']) : null;
                    $item['product_stock'] = !empty($item['product_stock']) && is_array($item['product_stock']) ?
                        json_encode($item['product_stock']) : null;
                    $items[] = $item;
                    if (isset($item['id'])) {
                        $existing_items[] = $item['id'];
                    }
                }
                if (!empty($existing_items)) {
                    OrderDetails::destroy($existing_items);
                }
                $items = $order->orderDetails()->createMany($items);
                $order->setAttribute('items', $items);
                DB::commit();
                return $this->jsonResponse($order->getAttributes(), $this->getTrans('success_msg'));
            } else {
                DB::rollBack();
                return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
            }
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
        }
    }

    public function updateStatus( Request $request)
    {
        try {
            $order = Order::find($request->id);
            if (!$order) {
                return $this->jsonResponse(null, $this->getTrans('warning_msg'));
            }
//            $result = Order::where('id', $request->id)->update($request->all());
            $order->setRawAttributes($request->all());
            if (!$order->save()) {
                return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
            }
            return $this->jsonResponse($order->getAttributes(), $this->getTrans('success_msg'));
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
        }
    }

    public function destroy($id)
    {
        try {
            $result = Order::find($id)->delete();
            if ($result) {
                return $this->jsonResponse(null, $this->getTrans('delete_msg'));
            }

            return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
        }
    }

    protected function upsertShippingDetails($order_id, $shipping_details)
    {
        if (!empty($shipping_details)) {
            if (!empty($shipping_details['id'])) {
                $shipping_id = $shipping_details['id'];
                $shipping = ShippingDetails::find($shipping_id);
                if (!$shipping) {
                    $shipping = new ShippingDetails;
                }
            } else {
                $shipping = new ShippingDetails;
            }

            $shipping_details['order_id'] = $order_id;
            $shipping->setRawAttributes($shipping_details);
            $shipping->save();
            return $shipping;
        }
        return null;
    }

}

