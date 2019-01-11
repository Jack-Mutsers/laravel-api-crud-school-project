<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Project_Controller@index');
Route::get('Supliers', 'Project_Controller@supliers');
Route::get('Suplier', 'Project_Controller@supliers');
Route::post('Product', 'Project_Controller@product');
Route::get('newProduct', 'Project_Controller@newproduct');
Route::get('Products', 'Project_Controller@products');