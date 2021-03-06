<?php
/**
 * CategoryService
 * @author : Tarek Monjur
 * @email : tarekmonjur@gmail.com
 */

namespace App\Http\Services;

use App\Models\Unit;
use Carbon\Carbon;

trait UnitService
{
    use DataModelService;

    private $id = null;
    private $slug = null;
    private $columns = ['id','name'];
    private $sub_list = true;
    private $trans_prefix = 'unit.';
    private $trans_key = 'list';
    private $paginate = true;
    private $limit = null;
    // columns config for table view
    private $columnsConfig = [
        'sl' => 100,
        'name' => 0,
        'products_count' => 0,
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
            'value' => null,
        ],
        [
            'name' => 'is_active',
            'label' => 'status',
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

    protected function generateFilters($dbModel)
    {
        $filters = $this->getFilters();
        if (empty($filters)) {
            return $dbModel;
        }
        if (isset($filters['name']) && !empty($filters['name'])) {
            $dbModel = $dbModel->where('name', 'like', '%'.$filters['name'].'%');
        }
        if (isset($filters['is_active'])) {
            $dbModel = $dbModel->where('is_active', (int)$filters['is_active']);
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
        $units = Unit::withCount(['products']);

        if ($columns = $this->getColumns()) {
            $units = $units->select($columns);
        }

        if ($sub_list) {
            $relations = [];

            if (!empty($this->getId())) {
                array_push($relations, 'products');
            }

            if ($this->authUser && $this->authUser->getTable() === 'users') {
                $relations = array_merge($relations, ['createdBy', 'updatedBy']);
            }

            if (!empty($relations)) {
                $units = $units->with($relations);
            }
        }

        if (!empty($this->getId())) {
            return $units->find($this->getId());
        } else {
            $units = $this->generateFilters($units);

            if ($this->getPaginate()) {
                $units = $units->paginate(config('app.backend_per_page'));
            } else {
                $units = $units->get();
            }
            return $units;
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

}
