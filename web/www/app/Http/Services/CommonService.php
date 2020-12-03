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

    protected function makeDir($path) {
        if ($path && !is_dir($path)) {
            if (!mkdir($path)) {
                return false;
            }
        }
        return true;
    }

}
