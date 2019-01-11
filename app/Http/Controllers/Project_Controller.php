<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use GuzzleHttp\Client;  //to install use: composer require guzzlehttp/guzzle
use Illuminate\Support\Facades\Route;

class Project_Controller extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function supliers()
    {

        return view('supliers.suplier');
    }

    public function products()
    {
        return view('producten.producten');
    }

    public function product(Request $request)
    {
        $name = $request->productname;
        $suppliers = $this->getSuppliers();
        $categories = $this->getCatagories();

        return view('producten.product', ['name'=> $name, 'suppliers' => $suppliers, 'categories' => $categories]);
    }

    public function newproduct()
    {        
        $suppliers = $this->getSuppliers();
        $categories = $this->getCatagories();

        return view('producten.newproduct', ['suppliers' => $suppliers, 'categories' => $categories]);
    }

    private function getCatagories()
    {
        $request = Request::create('/api/categories', 'GET');
        $response = Route::dispatch($request);
        
        return json_decode($response->content(), true)[0];
    }

    private function getSuppliers()
    {
        $request = Request::create('/api/suppliers', 'GET');
        $response = Route::dispatch($request);
        
        return json_decode($response->content(), true)[0];
    }
}
