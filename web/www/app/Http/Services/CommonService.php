<?php
/**
 * CommonService
 * @author : Tarek Monjur
 * @email : tarekmonjur@gmail.com
 */

namespace App\Http\Services;


trait CommonService
{
    /**
     * @description set the json response format
     * @param object $results
     * @param string $status
     * @param number $code
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     * @author Tarek Monjur
     */
    protected function jsonResponse($results = null, $message = '', $status = 'success', $code = 200)
    {
        $code = $code > 0 && $code < 599 ? $code : 500;
        $jsonData['status'] = $status;
        $jsonData['code'] = $code;
        $jsonData['message'] = $message;
        $jsonData['results'] = $results;
        return response()->json($jsonData,$code);
    }

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

    protected function setColumns(array $columns = null)
    {
        $columns = $columns ?? $this->columns;
        $columns_data = [];
        foreach ($columns as $key => $value) {
            $columns_data[$key]['name'] = $this->getTrans($key);
            $columns_data[$key]['width'] = $value;
        }
        $this->data['columns'] = $columns_data;
        return $this;
    }

    protected function getColumns($columns = null)
    {
        if ($columns) {
            $this->setColumns($columns);
        }
        return $this->data['columns'];
    }
}
