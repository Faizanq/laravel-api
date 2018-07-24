<?php
namespace App\Helpers;
use App;
use Response;

trait ApiResponseTrait {

    public function SuccessResponse($data, $status = 200, $headers = array(), $options = 0 ) {
        
        $response['error'] = array(); 
        $response['data'] = $data;
        $response['success'] = true; 
        return Response::json($response, $status, $headers, $options);
    }
    public function ErrorResponse($data, $status = 200, $headers = array(), $options = 0 ) {

        $response['error'] = array(); 
        $response['data'] = $data; 
        $response['success'] = false; 
        return Response::json($response, $status, $headers, $options);
    }
} 