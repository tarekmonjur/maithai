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
     * @param string $title
     * @return \Illuminate\Http\JsonResponse
     * @author Tarek Monjur
     */
    protected function jsonResponse($results, $status = 'success', $code = 200, $message = '', $title = ''){
        $jsonData['results'] = $results;
        $jsonData['status'] = $status;
        $jsonData['code'] = $code;
        $jsonData['title'] = $title;
        $jsonData['message'] = $message;
        return response()->json($jsonData,$code);
    }
}
