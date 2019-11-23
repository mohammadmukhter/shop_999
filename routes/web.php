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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/backend','BackendController@index');

Route::resource('/category','CategoryController');

Route::resource('/sub_category','SubCategoryController');
Route::post('/sub_category_ajax','SubCategoryController@ajax_data');

Route::resource('/product','ProductController');
Route::post('/sub_category_ajax','ProductController@ajax_data');

Route::resource('/unit','UnitController');
Route::post('/unit_ajax','UnitController@ajax_data');

Route::resource('/supplier','SupplierController');
Route::post('/supplier_edit_ajax','SupplierController@ajax_data');

Route::resource('/customer','CustomerController');
Route::post('/customer_ajax_data','CustomerController@ajax_data');

Route::resource('/purchase_list','PurchaseController');
Route::get('/purchase_create','PurchaseController@pur_create');
Route::get('/purchase_transaction','PurchaseController@pur_transaction');
Route::post('/purchase_ajax_data','PurchaseController@ajax_data');
Route::get('/p_voucher/{voucher_code}','PurchaseController@p_voucher');

Route::resource('/sale_list','SaleController');
Route::get('/sale_create','SaleController@sale_create');
Route::get('/sale_transaction','SaleController@sale_transaction');
Route::post('/sale_ajax_data','SaleController@ajax_data');
Route::get('/sale_invoice/{sale_invoice_code}','SaleController@s_invoice');

Route::resource('/vat','VatController');

Route::resource('/discount','DiscountController');

Route::get('/stock_report','StockReportController@index');
Route::post('/stock_show','StockReportController@show');

