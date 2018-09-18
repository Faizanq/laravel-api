<?php 
namespace App\Extensions;
use App\models\Token;
use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Str;
use Auth;
class TokenToUserProvider implements UserProvider
{
	
	private $token;
	private $user;
	public function __construct (User $user, Token $token) {
		$this->layout = false;
		$this->user = $user;
		$this->token = $token;
	}
	public function retrieveById ($identifier) {
		return $this->user->find($identifier);
	}
	public function retrieveByToken ($identifier, $token) {

		//for guest
		// dd(Auth::user(),'comug in auth');
		if(!Auth::check()){
			$token = $this->token->where($identifier, $token)->first();
			return $token;
		}
		//when user user login
		else {
			dd('ccominjh');
			$token = $this->token->with('user')->where($identifier, $token)->first();
			return $token && $token->user ? $token->user : null;
		}
			
		
	}
	public function updateRememberToken (Authenticatable $user, $token) {
		// update via remember token not necessary
	}

	public function updateIdAndDevice($identifier,$token,$device_id,$device_type) {
			$token = $this->token->where($identifier, $token)->first();
			if(!empty($token)){
			$token->device_type = !empty($device_type)?$device_type:$token->device_type; 
			$token->device_id   = !empty($device_id)?$device_id:$token->device_id;
			$token->save();
		}
	}

	public function retrieveByCredentials (array $credentials) {

		$user = $this->user;
		$credentials['password'] =  md5($credentials['password']);
		$credentials['access_token'] = explode(' ', $credentials['access_token'])[1];


		foreach ($credentials as $credentialKey => $credentialValue) {
			if (!(Str::contains($credentialKey, 'access_token') || Str::contains($credentialKey, 'password'))) {
				$user = $user->where($credentialKey, $credentialValue);
			}
		}
		$user = $user->first();
		if($user){
			$this->user = $user;
		 $token = $this->token->where('access_token', $credentials['access_token'])->first();
			if(!empty($token)){
			$token->user_id   = $user->id;
			$token->save();
		    }
		
		}
		return $this->user;
}
	public function validateCredentials (Authenticatable $user, array $credentials) {
		$plain = $credentials['password'];
		return app('hash')->check($plain, $user->getAuthPassword());
	}
}