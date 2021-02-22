<?php
/**
 * UserService
 * @author : Tarek Monjur
 * @email : tarekmonjur@gmail.com
 */

namespace App\Http\Services\User;

use App\Http\Services\DataModelService;
use App\Models\User;
use App\Models\UserDetails;
use Carbon\Carbon;

trait UserService
{
    use DataModelService;

    private $id = null;
    private $slug = null;
    private $columns = ['id','username', 'first_name', 'last_name', 'mobile_no', 'email'];
    private $sub_list = true;
    private $trans_prefix = 'user.';
    private $trans_key = 'list';
    private $paginate = true;
    private $limit = null;
    // columns config for table view
    private $columnsConfig = [
        'sl' => 50,
        'first_name' => 0,
        'last_name' => 0,
        'designation' => 0,
        'user_type' => 0,
        'service_type' => 0,
        'user_status' => 0,
        'email' => 0,
        'mobile_no' => 0,
        'photo' => 0,
        'gender' => 0,
        'salary' => 0,
        'is_active' => 0,
        'created' => 0,
        'updated' => 0,
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
            'name' => 'user_type',
            'label' => '',
            'type' => 'select',
            'options' => null,
        ],
        [
            'name' => 'service_type',
            'label' => '',
            'type' => 'select',
            'options' => null,
        ],
        [
            'name' => 'user_status',
            'label' => '',
            'type' => 'select',
            'options' => null,
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
        $customer = new User;

        if ($columns = $this->getColumns()) {
            $customer = $customer->select($columns);
        }

        if ($sub_list) {
            $relations = ['details'];

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

}
