<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\OrderRequest;
use App\Http\Services\OrderService;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $this->middleware('auth:'.$this->guard, ['except' => [], 'only' => []]);
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
//        try {
            $order_result = $this->makeOrder($request);
            DB::beginTransaction();
            $order = new Order();
            $order->setRawAttributes($order_result);
            $order->offsetUnset('items');
            $order->created_by = $this->authUser && $this->authUser->getTable() === 'users' ? $this->authUser->id : 0;
            if ($order->save()) {
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
                return $this->jsonResponse($order->getAttributes(), $this->getTrans('success_msg'));
            } else {
                DB::rollBack();
                return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
            }
//        } catch (\Exception $e) {
//            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
//        }
    }

    public function update(OrderRequest $request)
    {
        try {
            $order = Order::find($request->id);
            if (!$order) {
                return $this->jsonResponse('', $this->getTrans('warning_msg'));
            }

            $order_result = $this->makeOrder($request);
            DB::beginTransaction();
            $order->setRawAttributes($order_result);
            $order->offsetUnset('items');
            $order->created_by = $this->authUser && $this->authUser->getTable() === 'users' ? $this->authUser->id : 0;

            if ($order->save()) {
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

    public function destroy($id)
    {
        try {
            $result = Order::find($id)->delete();
            if ($result) {
                return $this->jsonResponse(null, $this->getTrans('success_msg'));
            }

            return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
        }
    }

}

