<?php

namespace App\Http\Controllers;
use App\models\Token;
use App\Http\Resources\TokenResource;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Extensions\SecurityTrait;

class TokenController extends Controller
{
    use SecurityTrait,ApiResponseTrait;
    
    public function index(Request $request){
    
        $token = new Token();
        $token->device_id = empty($request->device_id)?'':$request->device_id;
        $token->device_type = empty($request->device_id)?'':$request->device_id;
        $token->token_type = 'Bearer';
        $token->access_token = $this->generateRandomString();
        $token->save();

        $data = new TokenResource($token);
        return $this->SuccessResponse($data);

    }
}
