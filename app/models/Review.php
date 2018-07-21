<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function product(){
        return $this->belongsTo('App\models\Product','id');
    }
}
