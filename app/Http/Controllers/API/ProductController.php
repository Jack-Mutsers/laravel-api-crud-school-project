<?php

namespace App\Http\Controllers\API;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = product::all();
        //$products = $products->where('UnitsOnOrder', '>', '0');

        switch($request->filter){
            case 'InStock':
                if($request->status == "true"){
                    $products = $products->where('UnitsInStock', true);
                } else {
                    $products = $products->where('UnitsInStock', false);
                }
            break;
            case 'Ordered': 
                if($request->status == "true"){
                    $products = $products->where('UnitsOnOrder', '>', '0');
                } else {
                    $products = $products->where('UnitsOnOrder', '=', '0');
                }
            break;
            case 'Discontinued': 
                if($request->status == "true"){
                    $products = $products->where('Discontinued', 'n');
                } else {
                    $products = $products->where('Discontinued', 'y');
                }
            break;
        }
        
        return response()->json([$products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return 'store';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $Product)
    {
        return response()->json([$Product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        return 'update';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //return Product::destroy($product);
        return 'deleted';
    }
}
