<?php 
namespace App\Extensions;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;
use Auth;
class AccessTokenGuard implements Guard
{
	use GuardHelpers;
	private $inputKey = '';
	private $storageKey = '';
	private $request;
	private $data;
	private $muser;
	public function __construct (UserProvider $provider, Request $request, $configuration) {
		$this->provider = $provider;
		$this->request = $request;
		$this->data = $this->request->request->all();
		// key to check in request
		$this->inputKey = isset($configuration['input_key']) ? $configuration['input_key'] : 'access_token';
		// key to check in database
		$this->storageKey = isset($configuration['storage_key']) ? $configuration['storage_key'] : 'access_token';
	}
	public function user() {
		if (!is_null($this->user)) {
			return $this->user;
		}
		$user = null;
		// retrieve via token
		$token = $this->getTokenForRequest();
		if (!empty($token)) {
			if(!empty($this->data))
			$this->provider->updateIdAndDevice($this->storageKey,$token,$this->data['device_id'],$this->data['device_type']);
			// the token was found, how you want to pass?
			$user = $this->provider->retrieveByToken($this->storageKey, $token);
		}
		
		return $this->user = $user;
	}
	/**
	 * Get the token for the current request.
	 * @return string
	 */
	public function getTokenForRequest () {
		
		$token = $this->request->query($this->inputKey);
		if (empty($token)) {
			$token = $this->request->input($this->inputKey);
		}
		if (empty($token)) {
			$token = $this->request->bearerToken();
		}
		return $token;
	}
	/**
	 * Validate a user's credentials.
	 *
	 * @param  array $credentials
	 *
	 * @return bool
	 */
	public function validate (array $credentials = []) {
		if (empty($credentials[$this->inputKey])) {
			return false;
		}
		// $credentials = [ $this->storageKey => $credentials[$this->inputKey] ];
		if ($this->muser = $this->provider->retrieveByCredentials($credentials)) {
			return $this->muser;
			// return true;
		}
		return false;
	}

	public function muser(){
		dd($this->muser);
		if(empty($this->muser)){
			return null;
		}
		return $this->muser;

	}
}