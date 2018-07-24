<?php

namespace App\Http\Controllers;

use App\models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;
// use App\Http\Traits\SuccessResponseTrait;
// use App\Http\Traits\ErrorResponseTrait;
use App\Helpers\ApiResponseTrait;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use ApiResponseTrait;
    public function __construct()
    {
        $this->middleware('auth:token');

        // $this->middleware('log')->only('index');

        // $this->middleware('subscribed')->except('store');
    }
    
    public function index()
    {
        //  return ProductCollection::collection(Product::paginate());
        $data = ProductCollection::collection(Product::paginate());
        if($data){
            return  $this->SuccessResponse($data,$status = 200, $headers = array(), $options = 0 );
        }else{
            return  $this->ErrorResponse($data,$status = 401, $headers = array(), $options = 0 );
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // ProductResource::withoutWrapping();
        if(!empty($product)){
            $data = new ProductResource($product);
          return  $this->SuccessResponse($data,$status = 200, $headers = array(), $options = 0 );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
