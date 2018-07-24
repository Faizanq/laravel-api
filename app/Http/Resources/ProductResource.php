<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request);
        return [
        'name' => $this->name,
        'description' => $this->description,
        'price' => $this->price,
        'quantity' => $this->quantity,
        'discount' => $this->discount,
        'image' => $this->image,
        'review_count'=>$this->review->count(),
        'href'=>[
            'reviews'=>route('reviews.index',$this->id),
            'self'=>route('products.show',$this->id),
        ],
        'message'=> 'Product Detail',
        ];
    }
}
