<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function review(){
        return $this->hasMany('App\models\Review','product_id');
    }
}
