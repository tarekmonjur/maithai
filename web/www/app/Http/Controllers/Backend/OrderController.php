<?php

namespace App\Http\Controllers\Backend;

use App\Http\Services\OrderService;
use App\Models\Customer;
use App\Models\CustomerDetails;

class OrderController extends BackendController
{
    use OrderService;
    /*
    |--------------------------------------------------------------------------
    | Product Order/POS Controller
    |--------------------------------------------------------------------------
    |
    | @Description : Product Order/POS Manage
    | @Author : Tarek Monjur.
    | @Email  : tarekmonjur@gmail.com
    |
    */

    public function __construct(){
        parent::__construct();
        $this->middleware('auth:web');
    }

    public function index()
    {
        $this->setTitle();
        $this->setColumnsConfig();
        $this->setFiltersConfig();
        $customers = Customer::join('customer_details', 'customers.id', '=', 'customer_details.customer_id')
            ->select('customers.id', \DB::raw('concat(customer_details.first_name," ",customer_details.first_name," - ",customer_details.mobile_no) as text'))
            ->get()
            ->toArray();
        $this->setFiltersConfigData('customer_id', $customers);
        $this->data['scripts'] = ['order'];
        $this->data['styles'] = [];
        return view('backend.layouts.main')->with($this->data);
    }

    public function create()
    {
        $this->data['title'] = 'POS';
        $this->data['scripts'] = ['pos'];
        $this->data['styles'] = [];
        $this->data['sidebar_collapse'] = true;
        return view('backend.layouts.main')->with($this->data);
    }

}
