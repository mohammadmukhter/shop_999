<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SupplierModel;
use App\ProductModel;
use App\VatModel;
use App\DiscountModel;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        public function pur_create()
        {
            $supplier_data=SupplierModel::all();
            $product_data=ProductModel::all();

            $purchase_voucher_code= time();

            return view('purchase_create',['supplier_data'=>$supplier_data,'product_data'=>$product_data,'purchase_voucher_code'=>$purchase_voucher_code]);
        }


    public function index()
    {
        return view('purchase_list');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ajax_data(Request $request)
    {
        //echo $request->data_id;
        $data['product_array']=ProductModel::where('product_id',$request->data_id)->first();
        $vat_array=ProductModel::join('vat','product.product_id','=','vat.product_id')->where('product.product_id',$request->data_id)->select('vat.*')->first();
        if($vat_array)
        {
            $data['vat_array']=$vat_array;
        }

        $discount_array=ProductModel::join('discount','product.product_id','=','discount.product_id')->where('product.product_id',$request->data_id)->select('discount.*')->first();
        if($discount_array)
        {
            $data['discount_array']=$discount_array;
        }

        return $data;
    }
}
