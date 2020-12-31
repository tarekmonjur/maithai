<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\OrderRequest;
use App\Http\Services\OrderService;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;

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
        try {
            if ($request->status === 'completed' && $request->payment_type === 'none') {
                // set validate msg here...
            }
            $this->makeOrder($request);
            $order = new Order();
            if ($customer_id = intval($request->customer_id)) {
                $order->customer_id = $customer_id;
            } else if ($customer_id = intval($request->input('customer.id'))) {
                $order->customer_id = $customer_id;
            } else {
                $order->customer_id = $this->authUser->id;
            }

            $order->invoice_no = $this->getInvoiceNo($request->type);
            $order->table_id = $request->table_id ?? 0;
            $order->table_no = $request->table_no ?? $this->getTableNo($request->table_id);
            $offer = $this->getOfferByCode($request->coupon_code);
            if ($offer) {
                $order->offer_id = $offer->id ?? 0;
                $order->offer_name = $offer->name;
                $order->coupon_code = $offer->coupon_code;
            }
            $order->type = $request->type ?? 'sales';
            $order->source = $request->source ?? 'pos';
            $order->payment_type = $request->payment_type ?? 'none';
            $order->payment_status = $request->payment_status ?? 'pending';
            $order->status = $request->order_status ?? 'pending';
            $order->created_by = $this->authUser->id;

            if ($order->save()) {
                return $this->jsonResponse(null, $this->getTrans('success_msg'));
            } else {
                return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
            }
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
        }
    }


    public function update(OrderRequest $request)
    {
        try {
            $sku = Sku::find($request->id);
            if (!$sku) {
                return $this->jsonResponse('', $this->getTrans('warning_msg'));
            }

            $sku->name = $request->name;
            $sku->code = $request->code;
            $sku->location = $request->location;
            $sku->description = $request->description;
            $sku->is_active = $request->is_active;
            $sku->updated_by = $this->authUser->id;

           if ($sku->save()) {
               return $this->jsonResponse(null, $this->getTrans('success_msg'));
           } else {
               return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
           }
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
        }
    }

    public function destroy($id)
    {
        try {
            $result = Sku::find($id)->delete();
            if ($result) {
                return $this->jsonResponse(null, $this->getTrans('success_msg'));
            }

            return $this->jsonResponse(null, $this->getTrans('error_msg'), 'error');
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage(), $this->getTrans('error_msg'), 'error', $e->getCode());
        }
    }

}

