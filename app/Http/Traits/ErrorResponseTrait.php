<?php
namespace App\Http\Traits;

use App;
use Response;

Trait ErrorResponseTrait {

    public static function make( $message = '', $status = 200, array $headers = array(), $options = 0 ) {

        $response = App::make(
            'api_response_array',
            array(
                'content' => null,
                'error' => true,
                'error_description' => $message
            )
        );

        return Response::json($response, $status, $headers, $options);
    }
} 