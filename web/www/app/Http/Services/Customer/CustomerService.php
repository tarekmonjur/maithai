<?php
/**
 * CustomerService
 * @author : Tarek Monjur
 * @email : tarekmonjur@gmail.com
 */

namespace App\Http\Services\Customer;

use App\Http\Services\DataModelService;
use App\Models\Customer;
use App\Models\CustomerDetails;
use Carbon\Carbon;

trait CustomerService
{
    use DataModelService;

    private $id = null;
    private $slug = null;
    private $columns = ['id','username','referral_code', 'first_name', 'last_name', 'mobile_no', 'email'];
    private $sub_list = true;
    private $trans_prefix = 'customer.';
    private $trans_key = 'list';
    private $paginate = true;
    private $limit = null;
    // columns config for table view
    private $columnsConfig = [
        'sl' => 50,
        'username' => 0,
        'first_name' => 0,
        'last_name' => 0,
        'email' => 0,
        'mobile_no' => 0,
        'photo' => 0,
        'gender' => 0,
        'referral_code' => 0,
        'is_membership' => 0,
        'is_active' => 0,
        'email_verified' => 0,
        'action' => 100,
    ];
    private $filtersConfig = [
        [
            'name' => 'name',
            'label' => '',
            'type' => 'text',
            'value' => '',
        ],
        [
            'name' => 'email',
            'label' => '',
            'type' => 'text',
            'value' => '',
        ],
        [
            'name' => 'mobile_no',
            'label' => '',
            'type' => 'text',
            'value' => '',
        ],
        [
            'name' => 'is_active',
            'label' => '',
            'type' => 'select',
            'options' => [
                '1' => 'active',
                '0' => 'inactive'
            ]
        ],
        [
            'name' => 'is_membership',
            'label' => '',
            'type' => 'select',
            'options' => [
                '1' => 'yes',
                '0' => 'no'
            ]
        ],
        [
            'name' => 'email_verified',
            'label' => '',
            'type' => 'select',
            'options' => [
                '1' => 'verified',
                '0' => 'unverified'
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

    protected function setFiltersConfigData($key, $data) {
        $filters = $this->getFiltersConfig();
        if ($key) {
            foreach($filters as $index => $filter) {
                if ($filter['name'] === $key) {
                    $filters[$index]['options'] = $data;
                }
            }
        }
        $this->data['filters_config'] = $filters;
    }

    protected function generateFilters($dbModel)
    {
        $filters = $this->getFilters();
        if (empty($filters)) {
            return $dbModel;
        }
        if (isset($filters['full_name']) && !empty($filters['full_name'])) {
            $dbModel = $dbModel->where('first_name', 'like', '%'.$filters['full_name'].'%');
        }
        if (isset($filters['is_active'])) {
            $dbModel = $dbModel->where('is_active', (int)$filters['is_active']);
        }
        if (isset($filters['is_membership'])) {
            $dbModel = $dbModel->where('is_membership', (int)$filters['is_membership']);
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
        $sub_list = $this->getSubList();
        $customer = new Customer;

        if ($columns = $this->getColumns()) {
            $customer = $customer->select($columns);
        }

        if ($sub_list) {
            $relations = ['details'];
//            if (!empty($this->getId()) || !empty($this->getSlug())) {
//                array_push($relations);
//            }

            if ($this->authUser && $this->authUser->getTable() === 'users') {
                $relations = array_merge($relations, ['createdBy', 'updatedBy']);
            }

            if (!empty($relations)) {
                $customer = $customer->with($relations);
            }
        }

        if (!empty($this->getId())) {
            return $customer->find($this->getId());
        }
        else if (!empty($this->getSlug())) {
            return $customer->where('slug', $this->getSlug())
                ->get();
        } else {
            $customer = $this->generateFilters($customer);
            $customer->orderByDesc('created_at');
            $customer->orderByDesc('updated_at');

            if ($this->getPaginate()) {
                $customer = $customer->paginate(config('app.backend_per_page'));
            } else {
                $customer = $customer->get();
            }
            return $customer;
        }
    }

    protected function getDataModel()
    {
        $results = $this->getData()->toArray();
        if ((empty($this->getId()) && empty($this->getSlug())) &&
            $this->getPaginate()) {
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


    protected function generateReferralCode($first_name, $id = null, $mobile_no = null)
    {
        if (empty($id)) {
            $customer = Customer::orderBy('id','desc')->first();
            if ($customer) {
                $id = intval($customer->id) + 1;
            } else {
                $id = 1;
            }
        }

        $inputString = str_replace(' ', '-', $first_name);
        $inputString = preg_replace(['/[^A-Za-z0-9\-]/'], '', $inputString);
        $inputStringAry = explode("-", $inputString);
        foreach($inputStringAry as $val){
            if(strlen($val) > 2){
                $inputString = $val;
                break;
            }
        }

        if(empty($inputString)){
            $inputString = uniqid();
        }

        $name_prefix = $inputString;
        if(!empty($mobile_no)){
            $row_id_prefix = substr(str_pad($id,3,"0",STR_PAD_LEFT),-3);
            $mobile_prefix = str_shuffle(substr($mobile_no,-3));
        }else{
            $row_id_prefix = substr(str_pad($id,3,"0",STR_PAD_LEFT),-3);
            $mobile_prefix = null;
        }

        $generate_referral_code = "$name_prefix$row_id_prefix$mobile_prefix";
        return $generate_referral_code;
    }

    protected function getReferrerId($referrer_code)
    {
        $referral_customer = Customer::where('referral_code', $referrer_code)->first();
        if ($referral_customer) {
            return $referral_customer->id;
        }
        return null;
    }

}
