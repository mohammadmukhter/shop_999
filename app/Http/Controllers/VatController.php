<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductModel;
use App\VatModel;
use Validator;
use Toastr;
use Redirect;

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
        $status=VatModel::where('vat_id',$id)->first();

        if($status->vat_status=='0')
        {
            $updated=$status->update(['vat_status'=>'1']);
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
            $updated=$status->update(['vat_status'=>'0']);
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
    
        $edit_data=VatModel::join('product','vat.product_id','=','product.product_id')->where('vat_id',$id)->first();
        return view('vat_edit',['edit_data'=>$edit_data]);
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
        $update=VatModel::where('vat_id',$id)->first();
        $validate=Validator::make($request->all(),$update->Validation_edit());
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

            $updated=$update->fill($request->all())->save();
            if($updated)
            {
                Toastr::success('Data Inserted Successfully','Success!!',['positionClass'=>'toast-top-right']);
            }
            else
            {
                Toastr::error('Something Went Wrong','Error!!',['positionClass'=>'toast-top-right']);
            }
            return redirect::to('/vat');
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
        $data=VatModel::where('vat_id',$id)->first();
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
