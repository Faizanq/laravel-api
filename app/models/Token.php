<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = 'userdevices';
    protected $primaryKey = 'access_token';
    

    protected $fillable = [ 'token_type', 'user_id', 'access_token' ];

	public function user() {
		return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
}
