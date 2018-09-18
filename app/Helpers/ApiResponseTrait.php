<?php
namespace App\Helpers;
use App;
use Response;

trait ApiResponseTrait {

    public function SuccessResponse($data, $status = 200, $headers = array(), $options = 0, $message='')
    {
        
        $response['error'] = array(); 
        $response['data'] = $data;
        if(!empty($message))
         $response['data']['message'] = $message;
        $response['success'] = true; 
        return Response::json($response, $status, $headers, $options);
    }
    public function ErrorResponse($data, $status = 200, $headers = array(), $options = 0, $message='' ) {

        // $response['error'] = array(); 
         if(!empty($message))
             $response['error'][] = $message;  
        $response['data'] = $data;  
        $response['success'] = false; 
        return Response::json($response, $status, $headers, $options);
    }
} 