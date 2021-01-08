<?php
/**
 * TableService
 * @author : Tarek Monjur
 * @email : tarekmonjur@gmail.com
 */

namespace App\Http\Services;

use App\Models\Table;
use Carbon\Carbon;

trait TableService
{
    use DataModelService;

    private $id = null;
    private $slug = null;
    private $columns = ['id','table_no', 'description'];
    private $sub_list = true;
    private $trans_prefix = 'table.';
    private $trans_key = 'list';
    private $paginate = true;
    // columns config for table view
    private $columnsConfig = [
        'sl' => 100,
        'table_no' => 0,
        'description' => 0,
        'is_active' => 0,
        'created' => 0,
        'updated' => 0,
        'action' => 100,
    ];
    private $filtersConfig = [
        [
            'name' => 'table_no',
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
        if (isset($filters['table_no']) && !empty($filters['table_no'])) {
            $dbModel = $dbModel->where('table_no', 'like', '%'.$filters['table_no'].'%');
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
        $table = new Table;

        if ($columns = $this->getColumns()) {
            $table = $table->select($columns);
        }

        if ($sub_list) {
            $relations = [];

            if ($this->authUser && $this->authUser->getTable() === 'users') {
                $relations = array_merge($relations, ['createdBy', 'updatedBy']);
            }

            if (!empty($relations)) {
                $table = $table->with($relations);
            }
        }

        if (!empty($this->getId())) {
            return $table->find($this->getId());
        } else {
            $table = $this->generateFilters($table);

            if ($this->getPaginate()) {
                $table = $table->paginate(config('app.backend_per_page'));
            } else {
                $table = $table->get();
            }
            return $table;
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
