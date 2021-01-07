<?php
/**
 * CategoryService
 * @author : Tarek Monjur
 * @email : tarekmonjur@gmail.com
 */

namespace App\Http\Services;

use App\Http\Controllers\Api\ProductController;
use App\Models\Order;
use App\Models\Table;
use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Http\Request;

trait OrderService
{
    use DataModelService;

    private $id = null;
    private $slug = null;
    private $columns = ['id','invoice_no'];
    private $sub_list = true;
    private $trans_prefix = 'order.';
    private $trans_key = 'list';
    private $paginate = true;
    // columns config for table view
    private $columnsConfig = [
        'sl' => 50,
        'invoice_no' => 0,
        'type' => 0,
        'source' => 0,
        'customer' => 0,
        'transaction_no' => 0,
        'payment' => 0,
        'status' => 0,
        'table' => 0,
        'total_items' => 0,
        'total_qty' => 0,
        'sub_total' => 0,
        'offer' => 0,
        'discount' => 0,
        'vat' => 0,
        'fee' => 0,
        'payable_amount' => 0,
        'pay_amount' => 0,
        'due_amount' => 0,
        'action' => 100,
    ];
    private $filtersConfig = [
        [
            'name' => 'invoice_no',
            'label' => '',
            'type' => 'text',
            'value' => null,
        ],
        [
            'name' => 'customer_id',
            'label' => 'customer',
            'type' => 'select2',
            'options' => null,
        ],
        [
            'name' => 'payment_status',
            'label' => '',
            'type' => 'select',
            'options' => [
                'pending' => 'pending',
                'due' => 'due',
                'completed' => 'completed',
            ],
        ],
        [
            'name' => 'type',
            'label' => 'order_type',
            'type' => 'select',
            'options' => [
                'sales' => 'sales',
                'purchase' => 'purchase'
            ],
        ],
        [
            'name' => 'source',
            'label' => 'order_source',
            'type' => 'select',
            'options' => [
                'pos' => 'pos',
                'online' => 'online'
            ]
        ],
        [
            'name' => 'status',
            'label' => 'order_status',
            'type' => 'select',
            'options' => [
                'placed' => 'placed',
                'pending' => 'pending',
                'accepted' => 'accepted',
                'delivered' => 'delivered',
                'completed' => 'completed',
                'cancel' => 'cancel',
            ]
        ],
        [
            'name' => 'from_date',
            'label' => '',
            'type' => 'date',
            'value' => '',
        ],
        [
            'name' => 'to_date',
            'label' => '',
            'type' => 'date',
            'value' => 0, // months
        ],
    ];
    private $filters = [];
    private $data = [];

    protected function generateFilters($dbModel)
    {
        $filters = $this->getFilters();
        if (empty($filters)) {
            return $dbModel;
        }
        if (isset($filters['customer_id'])) {
            $dbModel = $dbModel->where('customer_id', (int)$filters['customer_id']);
        }
        if (isset($filters['invoice_no']) && !empty($filters['invoice_no'])) {
            $dbModel = $dbModel->where('invoice_no', 'like', '%'.$filters['invoice_no'].'%');
        }
        if (isset($filters['payment_status']) && !empty($filters['payment_status'])) {
            $dbModel = $dbModel->where('payment_status', $filters['payment_status']);
        }
        if (isset($filters['type']) && !empty($filters['type'])) {
            $dbModel = $dbModel->where('type', $filters['type']);
        }
        if (isset($filters['source']) && !empty($filters['source'])) {
            $dbModel = $dbModel->where('source', $filters['source']);
        }
        if (isset($filters['status']) && !empty($filters['status'])) {
            $dbModel = $dbModel->where('status', $filters['status']);
        }
        if (isset($filters['from_date']) && !empty($filters['from_date'])) {
            $from_date = Carbon::parse($filters['from_date'])->format('Y-m-d');
            $dbModel = $dbModel->whereDate('created_at', '>=', $from_date);
        }
        if (isset($filters['to_date']) && !empty($filters['to_date'])) {
            $to_date = Carbon::parse($filters['to_date'])->format('Y-m-d');
            $dbModel = $dbModel->whereDate('created_at', '<=', $to_date);
        }

        return $dbModel;
    }

    protected function getData()
    {
        $order = Order::withCount('orderDetails');

        if ($columns = $this->getColumns()) {
            $order = $order->select($columns);
        }

        if ($this->getSubList()) {
            $relations = ['customer', 'shippingDetails'];

            if (!empty($this->getId())) {
                array_push($relations, 'table', 'offer', 'orderDetails');
            }

            if ($this->authUser && $this->authUser->getTable() === 'users') {
                $relations = array_merge($relations, ['createdBy', 'updatedBy']);
            }

            if (!empty($relations)) {
                $order = $order->with($relations);
            }
        }

        if (!empty($this->getId())) {
            return $order->find($this->getId());
        } else {
            $order = $this->generateFilters($order);
            $order = $order->orderByDesc('created_at');

            if ($this->getPaginate()) {
                $order = $order->paginate(config('app.backend_per_page'));
            } else {
                $order = $order->get();
            }
            return $order;
        }
    }

    protected function getDataModel()
    {
        $results = $this->getData()->toArray();
        if (empty($this->getId()) && $this->getPaginate()) {
            foreach($results as $key => $result) {
                if ($key !== 'data') {
                    $this->data['metadata'][$key] = $results[$key];
                }
            }
            $this->data['results'] = $results['data'];
        } else {
            $this->data['results'] = $results;
        }

        return $this->data;
    }

    protected function getInvoiceNo($type = null)
    {
        if (empty($type)) {
            $type = 'O';
        } else if ($type === 'sales') {
            $type = 'S';
        } else if ($type === 'purchase') {
            $type = 'P';
        }
        return uniqid($type);
    }

    protected function getTableNo($id = null)
    {
        $table_no = null;
        if (!empty($id)) {
            $table = Table::find($id)->first('table_no');
            $table_no = $table ? $table->table_no : null;
        }
        return $table_no;
    }

    protected function getOfferByCode($coupon_code = null)
    {
        $offer = null;
        if (!empty($coupon_code)) {
            $to_date = Carbon::now()->format('YY-mm-dd');
            $offer = Offer::where('coupon_code', $coupon_code)
                ->where('offer_type', 'coupon')
                ->where('is_active', 1)
                ->whereDate('start_date', '<=', $to_date)
                ->whereDate('end_date', '>=', $to_date)
                ->first();
        }
        return $offer;
    }

    protected function makeItem($product_id)
    {
        if (!$product_id) {
            return [];
        }

        $productController = new ProductController();
        $request = new Request;
        $request->id_slug = $product_id;
//        dd($product->show($re)->getOriginalContent());
        $product = $productController->show($request)->getOriginalContent();

        $product_price = $product->special_price && $product->special_price > 0 ?
            $product->special_price : $product->regular_price;
        $vat_percent = $product->vat_percent;
        $vat_amount = $vat_percent && $vat_percent > 0 ?
            ($product_price * $vat_percent) / 100 : 0;
        $vat_amount = round($vat_amount, 2);
        $discount_percent = 0;
        $discount_amount = 0;

        if ($product->offer) {
            $discount_percent = $product->offer->discount_type === 'percent' ?
                $product->offer->discount : 0;
            $discount_amount = $product->offer->discount_type === 'amount' ?
                $product->offer->discount : 0;
            if ($discount_percent && !$discount_amount) {
                $discount_amount = round(($product_price * $discount_percent) / 100, 2);
            } else {
                $discount_percent = round(($discount_amount * 100) / $product_price, 2);
            }
        }

        $product_variants = [];
        if ($product->variants && !empty($product->variants)) {
            foreach($product->variants as $variant) {
                $variant_name = $variant->variant ? $variant->variant->name : '';
                $sub_variant_name = $variant->subvariant ? $variant->subvariant->name : '';
                $product_variants[] = [
                  'id' => $variant->id,
                  'additional_price' => $variant->additional_price,
                  'variant' => $variant_name.'-'.$sub_variant_name,
                  'is_added' => false,
                ];
            }
        }

        $product_stocks = [];
        if ($product->stocks && !empty($product->stocks)) {
            foreach($product->stocks as $stock) {
                $sku_name = $stock->sku ? $stock->sku->name : '';
                $product_stocks[] = [
                    'id' => $stock->id,
                    'stock' => $stock->stock,
                    'sku' => $sku_name,
                    'is_added' => false,
                ];
            }
        }

        $price = round(($product_price + $vat_amount) - $discount_amount, 2);
        $item = [
            'order_id' => null,
            'product_id' => $product->id,
            'offer_id' => $product->offer ? $product->offer->id : 0,
            'offer_name' => $product->offer ? $product->offer->name: null,
            'product_name' => $product->name,
            'product_code' => $product->name,
            'product_barcode' => $product->name,
            'product_unit' => $product->unit ? $product->unit->name : null,
            'product_variant' => $product_variants,
            'product_stock' => $product_stocks,
            'product_price' => $product_price,
            'product_qty' => 1,
            'discount_percent' => $discount_percent,
            'discount_amount' => $discount_amount,
            'vat_percent' => $vat_percent,
            'vat_amount' => $vat_amount,
            'price' => $price,
            'sub_total' => $price,
            'item_lock' => false,
        ];

        return $item;
    }

    protected function makeShippingDetails($request)
    {
        $shippingDetails = [];
        if (!empty($request->input('shipping_details.full_name')) &&
            !empty($request->input('shipping_details.mobile_no'))) {
            $shippingDetails['id'] = $request->input('shipping_details.id');
            $shippingDetails['full_name'] = $request->input('shipping_details.full_name');
            $shippingDetails['email'] = $request->input('shipping_details.email');
            $shippingDetails['mobile_no'] = $request->input('shipping_details.mobile_no');
            $shippingDetails['city'] = $request->input('shipping_details.city');
            $shippingDetails['state'] = $request->input('shipping_details.state');
            $shippingDetails['zip_code'] = $request->input('shipping_details.zip_code');
            $shippingDetails['address'] = $request->input('shipping_details.address');
        }
        return $shippingDetails;
    }

    protected function makeOrder($request)
    {
        $order = [];
        if (empty($request->items)) {
            return $order;
        }

        if ($request->id) {
            $order['id'] = $request->id;
        }

        if ($customer_id = intval($request->customer_id)) {
            $order['customer_id'] = $customer_id;
        } else if ($customer_id = intval($request->input('customer.id'))) {
            $order['customer_id'] = $customer_id;
        } else {
            $order['customer_id'] = $this->authUser ? $this->authUser->id : -1;
        }

        $order['shipping_details'] = $this->makeShippingDetails($request);

        $total_qty = 0;
        $total_sub_total_amount = 0;
        $total_sub_discount_percent = 0;
        $total_sub_discount_amount = 0;
        $total_sub_vat_percent = 0;
        $total_sub_vat_amount = 0;

        foreach($request->items as $item) {
            if ($request->order_source !== 'pos') {
                $new_item = $this->makeItem($item['product_id']);
                if (!empty(intval($item['id']))) {
                    $new_item['id'] = (int) $item['id'];
                }
                $item = $new_item;
                // manage variants and stocks here...
            }

            if (!empty($item)) {
                $order['items'][] = $item;
                $total_qty = $total_qty + $item['product_qty'] ?? 0;
                $total_sub_total_amount = $total_sub_total_amount + $item['sub_total'] ?? 0;
                $total_sub_discount_percent = $total_sub_discount_percent + $item['discount_percent'] ?? 0;
                $total_sub_discount_amount = $total_sub_discount_amount + $item['discount_amount'] ?? 0;
                $total_sub_vat_percent = $total_sub_vat_percent + $item['vat_percent'] ?? 0;
                $total_sub_vat_amount = $total_sub_vat_amount + $item['vat_amount'] ?? 0;
            }
        }

        $order['invoice_no'] = $this->getInvoiceNo($request->type);
        $order['table_id'] = $request->table_id;
        $order['table_no'] = $request->table_no ?? $this->getTableNo($request->table_id);

        if ($request->order_source !== 'pos') {
            $discount_percent = 0;
            $discount_amount = 0;
            $offer = $this->getOfferByCode($request->coupon_code);
            if ($offer) {
                $offer_id = $offer->id;
                $offer_name = $offer->name;
                $coupon_code = $offer->coupon_code;
                $discount_percent = $offer->discount_type === 'percent' ?
                    $offer->discount : 0;
                $discount_amount = $offer->discount_type === 'amount' ?
                    $offer->discount : 0;
                if (!empty($discount_percent) && empty($discount_amount)) {
                    $discount_amount = round(($total_sub_total_amount * $discount_percent) / 100, 2);
                } else {
                    $discount_percent = round(($discount_amount * 100) / $total_sub_total_amount, 2);
                }
            }
            $vat_percent = 0;
            $vat_amount = 0;
            $delivery_fee = 0;
            $processing_fee = 0;
            $total_discount_percent = $discount_percent + $total_sub_discount_percent;
            $total_discount_amount = $discount_amount + $total_sub_discount_amount;
            $total_vat_percent = $vat_percent + $total_sub_vat_percent;
            $total_vat_amount = $vat_amount + $total_sub_vat_amount;
            $total_payable_amount = ($total_sub_total_amount + $total_vat_amount + $delivery_fee + $processing_fee) - $total_discount_amount;
            $due_amount = $total_payable_amount;
            $total_pay_amount = 0;
        } else {
            $offer_id = $request->offer_id;
            $offer_name = $request->offer_name;
            $coupon_code = $request->coupon_code;
            $discount_percent = $request->discount_percent;
            $discount_amount = $request->discount_amount;
            $vat_percent = $request->vat_percent;
            $vat_amount = $request->vat_amount;
            $delivery_fee = $request->delivery_fee;
            $processing_fee = $request->processing_fee;
            $total_discount_percent = $discount_percent + $total_sub_discount_percent;
            $total_discount_amount = $discount_amount + $total_sub_discount_amount;
            $total_vat_percent = $vat_percent + $total_sub_vat_percent;
            $total_vat_amount = $vat_amount + $total_sub_vat_amount;
            $total_payable_amount = ($total_sub_total_amount + $total_vat_amount + $delivery_fee + $processing_fee) - $total_discount_amount;
            $total_pay_amount = $request->received_amount;
            $due_amount = $total_payable_amount - $total_pay_amount;
        }

        $payment_status = $request->payment_type !== 'none' ?
            $due_amount <= 0 ? 'completed' : 'due'
            : 'pending';
        $order_status = $request->order_status ?? $payment_status === 'completed' ?? 'pending';

        $order['offer_id'] = $offer_id;
        $order['offer_name'] = $offer_name;
        $order['coupon_code'] = $coupon_code;
        $order['type'] = $request->type ?? 'sales';
        $order['source'] = $request->source ?? 'pos';
        $order['payment_type'] = $request->payment_type ?? 'none';
        $order['payment_status'] = $payment_status;
        $order['status'] = $order_status;
        $order['total_qty'] = $total_qty;
        $order['total_sub_total_amount'] = round($total_sub_total_amount, 2);
        $order['total_sub_discount_percent'] = round($total_sub_discount_percent, 2);
        $order['total_sub_discount_amount'] = round($total_sub_discount_amount, 2);
        $order['total_sub_vat_percent'] = round($total_sub_vat_percent, 2);
        $order['total_sub_vat_amount'] = round($total_sub_vat_amount, 2);
        $order['discount_percent'] = round($discount_percent, 2);
        $order['discount_amount'] = round($discount_amount, 2);
        $order['vat_percent'] = round($vat_percent, 2);
        $order['vat_amount'] = round($vat_amount, 2);
        $order['delivery_fee'] = round($delivery_fee, 2);
        $order['processing_fee'] = round($processing_fee, 2);
        $order['total_payable_amount'] = round($total_payable_amount, 2);
        $order['due_amount'] = round($due_amount, 2);
        $order['total_pay_amount'] = round($total_pay_amount, 2);
        return $order;
    }

}
