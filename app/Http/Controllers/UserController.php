<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ApiResponseTrait;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use Auth;
class UserController extends Controller
{
    use ApiResponseTrait;

    public function __construct()
      {
          $this->middleware('auth:token');

          // $this->middleware('log')->only('index');

          // $this->middleware('subscribed')->except('store');
      }

    public function Register(Request $request){

       $validation = $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
            'name'=>'required',
            'device_id'=>'required',
            'device_type'=>'required',
            ]);

          $user = new User;
          $user->name = $request->name;
          $user->email = $request->email;
          $user->password = $request->password;
          $user->save();
      
      return $this->SuccessResponse([],200,[],0,'Successfully register');

    }

    public function Login(Request $request){

       $validation = $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
            'device_id'=>'required',
            'device_type'=>'required',
            ]);
        $user = Auth::validate(array('email' => $request->get('email'), 'password' => $request->get('password'),'access_token'=>$request->header('Authorization')));

        $data = new UserResource($user);

      return $this->SuccessResponse($data,200,[],0);

    }

    public function UserListing(Request $request){
        $data = UserCollection::collection(User::all());
        $email = 'qureshi@peerbits.com';
        $password = md5('123123');
        // dd(Auth::attempt(['email' => $email, 'password' => $password]));
        dd(Auth::muser());
        $user = Auth::id();
  
      return $this->SuccessResponse($data,200,[],0);

    }


      // $data = $request->all();
      // $validator = $this->validator($data);

      //   if ($validator->fails()) {
      //       $this->setStatusCode(422);
      //       return $this->respondWithError($validator->errors());
      //   }
    
      // private function validator($data)
      // {
      //     return Validator::make($data, [
      //       'email' => 'required|email|max:50',
      //       'name' => 'required',
      //       'device_id' => 'required',
      //       'device_type' => 'required'
      //     ]);
      // }

}
