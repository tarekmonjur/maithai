<?php
/**
 * DataModelService
 * @author : Tarek Monjur
 * @email : tarekmonjur@gmail.com
 */

namespace App\Http\Services;


use Carbon\Carbon;

trait DataModelService
{

    protected function getTrans($key)
    {
        return trans($this->trans_prefix.$key);
    }

    protected function setTitle($trans_key = null)
    {
        $trans_key = $trans_key ?? $this->trans_key;
        $title = $this->getTrans($trans_key);
        $this->data['title'] = $title;
        return $this;
    }

    protected function getTitle($trans_key = null)
    {
        if ($trans_key) {
            $this->setTitle($trans_key);
        }
        return $this->data['title'];
    }

    protected function setIdSlug($id_slug)
    {
        if (is_numeric($id_slug)){
            $this->id = intval($id_slug);
        } else {
            $this->slug = strval($id_slug);
        }

        return $this;
    }

    protected function getId()
    {
        return $this->id;
    }

    protected function getSlug()
    {
        return $this->slug;
    }

    protected function setSubList($sub_list = null)
    {
        $sub_list = $sub_list ?? $this->sub_list;
        if (!is_bool($sub_list)) {
            $sub_list = trim(strtolower($sub_list)) === 'true';
        }
        $this->sub_list = $sub_list;
        return $this;
    }

    protected function getSubList($sub_list = null)
    {
        if ($sub_list) {
            $this->setSubList($sub_list);
        }
        return $this->sub_list;
    }

    protected function setPaginate($paginate = null)
    {
        $paginate = $paginate ?? $this->paginate;
        if (!is_bool($paginate)) {
            $paginate = trim(strtolower($paginate)) === 'true';
        }
        $this->paginate = $paginate;
        return $this;
    }

    protected function getPaginate($paginate = null)
    {
        if ($paginate) {
            $this->setPaginate($paginate);
        }
        return $this->paginate;
    }

    protected function setColumns($columns)
    {
        if ($columns) {
            $columns = explode(',', $columns);
            $columns = array_intersect($this->columns, $columns);
        }

        $this->columns = $columns;
        return $this;
    }

    protected function getColumns()
    {
        return $this->columns;
    }

    protected function setColumnsConfig(array $columns = null)
    {
        $columns = $columns ?? $this->columnsConfig;
        $columns_data = [];
        foreach ($columns as $key => $value) {
            $columns_data[$key]['name'] = $this->getTrans($key);
            $columns_data[$key]['width'] = $value;
        }
        $this->data['columns_config'] = $columns_data;
        return $this;
    }

    protected function getColumnsConfig($columns = null)
    {
        if ($columns) {
            $this->setColumnsConfig($columns);
        }
        return $this->data['columns_config'];
    }

    protected function setFiltersConfig($filters = null)
    {
        $filters = $filters ?? $this->filtersConfig;
        $filters_config = [];

        foreach($filters as $filter) {
            $filter['label'] = !empty($filter['label']) ?
                $this->getTrans($filter['label']) :
                $this->getTrans($filter['name']);

            if (isset($filter['options'])) {
                $options = [];
                foreach($filter['options'] as $key => $value) {
                    $options[] = [
                        'label' => $this->getTrans($value),
                        'value' => $key,
                    ];
                }
                $filter['options'] = $options;
            }

            if ($filter['type'] === 'date' && is_int($filter['value'])) {
                if ($filter['value'] !== 0) {
                    $filter['value'] = Carbon::parse()->addMonths($filter['value']);
                } else {
                    $filter['value'] = Carbon::now();
                }
            }

            $filters_config[] = $filter;
        }

        $this->data['filters_config'] = $filters_config;
        return $this;
    }

    protected function getFiltersConfig($filters = null)
    {
        if ($filters) {
            $this->setFiltersConfig($filters);
        }
        return $this->data['filters_config'];
    }

    protected function setFilter($key, $value)
    {
        $this->data['filters'][$key] = $value;
        return $this;
    }

    protected function setFilters($filters)
    {
        $filters['columns'] = $this->setColumns($filters['columns'] ?? null)->getColumns();
        $filters['sublist'] = $this->getSubList($filters['sublist'] ?? null);
        $filters['paginate'] = $this->getPaginate($filters['paginate'] ?? null);
        $this->data['filters'] = $filters;
        return $this;
    }

    protected function getFilters()
    {
        return $this->data['filters'] ?? [];
    }

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
}
