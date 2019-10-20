<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductModel;
use App\VatModel;
use Validator;
use Toastr;

class VatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_data=ProductModel::all();

        $vat_data=VatModel::join('product','vat.product_id','=','product.product_id')->orderBy('vat.created_at','desc')->get();
        
        return view('vat',['product_data'=>$product_data,'vat_data'=>$vat_data]);
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
        $vat_insert= new VatModel;
        $validate=Validator::make($request->all(),$vat_insert->Validation());
        if($validate->fails())
        {
            return back()->withErrors($validate);     
        }
        else
        {
            if($request->purchase_vat < 0)
            {
                Toastr::Error('Negative Number!!!','Error!',['positionClass'=>'toast-top-right']);
                return back();
            }

            if($request->sale_vat < 0)
            {
                Toastr::Error('Negative Number!!!','Error!',['positionClass'=>'toast-top-right']);
                return back();
            }

            $inserted=$vat_insert->fill($request->all())->save();
            if($inserted)
            {
                Toastr::success('Data Inserted Successfully','Success!!',['positionClass'=>'toast-top-right']);
            }
            else
            {
                Toastr::error('Something Went Wrong','Error!!',['positionClass'=>'toast-top-right']);
            }
            return back();
        }

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
}
