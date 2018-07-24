<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function Register(Request $request){

      $data = $request->all();
      $validator = $this->validator($data);

        if ($validator->fails()) {
            $this->setStatusCode(422);
            return $this->respondWithError($validator->errors());
        }

    }


    
    private function validator($data)
    {
        return Validator::make($data, [
          'email' => 'required|email|max:50',
          'name' => 'required',
          'device_id' => 'required',
          'device_type' => 'required'
        ]);
    }

}
