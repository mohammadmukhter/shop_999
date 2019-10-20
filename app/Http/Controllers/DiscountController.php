<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductModel;
use App\DiscountModel;
use Validator;
use Toastr;
use Redirect;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_data=ProductModel::all();
        $discount_data= DiscountModel::join('product','discount.product_id','=','product.product_id')->orderby('discount.created_at','desc')->get();
        return view('/discount',['product_data'=>$product_data,'discount_data'=>$discount_data]);
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
        $data= new DiscountModel;
        $validate=Validator::make($request->all(),$data->Validation());
        if($validate->fails())
        {
            return back()->withErrors($validate);
        }
        else
        {
            if($request->purchase_discount < 0)
            {
                Toastr::Error('Negative Number!!!','Error!',['positionClass'=>'toast-top-right']);
                return back();
            }

            if($request->sale_discount < 0)
            {
                Toastr::Error('Negative Number!!!','Error!',['positionClass'=>'toast-top-right']);
                return back();
            }

            $inserted=$data->fill($request->all())->save();
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
        $status=DiscountModel::where('discount_id',$id)->first();

        if($status->discount_status=='0')
        {
            $updated=$status->update(['discount_status'=>'1']);
            if($updated)
            {
                Toastr::success('Status Changed Successfully','Success!!',['positionClass'=>'toast-top-right']);
            }
            else
            {
                Toastr::error('Something Went Wrong','Error!!',['positionClass'=>'toast-top-right']);
            }
        }
        else
        {
            $updated=$status->update(['discount_status'=>'0']);
            if($updated)
            {
                Toastr::success('Status Changed Successfully','Success!!',['positionClass'=>'toast-top-right']);
            }
            else
            {
                Toastr::error('Something Went Wrong','Error!!',['positionClass'=>'toast-top-right']);
            }
        }
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_data=DiscountModel::join('product','discount.product_id','=','product.product_id')->where('discount_id',$id)->first();
        return view('discount_edit',['edit_data'=>$edit_data]);
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
        $update=DiscountModel::where('discount_id',$id)->first();
        $validate=Validator::make($request->all(),$update->Validation_edit());
        if($validate->fails())
        {
            return back()->withErrors($validate);
        }
        else
        {
            if($request->purchase_discount < 0)
            {
                Toastr::Error('Negative Number!!!','Error!',['positionClass'=>'toast-top-right']);
                return back();
            }

            if($request->sale_discount < 0)
            {
                Toastr::Error('Negative Number!!!','Error!',['positionClass'=>'toast-top-right']);
                return back();
            }

            $updated=$update->fill($request->all())->save();
            if($updated)
            {
                Toastr::success('Data Inserted Successfully','Success!!',['positionClass'=>'toast-top-right']);
            }
            else
            {
                Toastr::error('Something Went Wrong','Error!!',['positionClass'=>'toast-top-right']);
            }
            return redirect::to('/discount');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=DiscountModel::where('discount_id',$id)->first();
        $deleted=$data->delete();
        if($deleted)
        {
            Toastr::success('Data Deleted Successfully','Success!',['positionClass'=>'toast-top-right']);
        }
        else
        {
            Toastr::error('Something Went Wrong','Error!',['positionClass'=>'toast-top-right']);
        }
        return back();
    }
}
