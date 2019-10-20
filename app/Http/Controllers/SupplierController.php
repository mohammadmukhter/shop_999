<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\SupplierModel;
use Validator;
use Toastr;
use File;
use Arr;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier_data=SupplierModel::orderby('created_at','desc')->get();
        return view('supplier',['supplier_data'=>$supplier_data]);
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
        $supplier= new SupplierModel;
        $validate=Validator::make($request->all(),$supplier->Validation());
        if($validate->fails())
        {
            return back()->withErrors($validate);
        }
        else
        {

            $requested_data=$request->all();

            if($request->image)
            {
                $file=$request->file('image');
                $name=time().'.'.$file->getClientOriginalExtension();
                $requested_data=Arr::set($requested_data,'image',$name);
                $request->file('image')->move('image_upload', $name);
            }
            $inserted=$supplier->fill($requested_data)->save();
                if($inserted)
                {
                    Toastr::success('Data Inserted Successfully','Success!!', ['positionClass'=>'toast-top-right']);
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
        $status=SupplierModel::find($id);
        if($status->supplier_status=='0')
        {
            $status->update(['supplier_status'=>'1']);
            Toastr::success('Status Changed Successfully','Success!!',['positionClass'=>'toast-top-right']);

        }
        else
        {
            $status->update(['supplier_status'=>'0']);
            Toastr::success('Status Changed Successfully','Success!!',['positionClass'=>'toast-top-right']);
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
        $update=SupplierModel::find($id);
        $validate=Validator::make($request->all(),$update->Validation());
        if($validate->fails())
        {
            return back()->withErrors($validate);
        }
        else
        {
            $requested_data=$request->all();
                if($request->image)
                {
                    $file=$request->file('image');
                    $name= time().'.'.$file->getClientOriginalExtension();
                    $requested_data=Arr::set($requested_data,'image',$name);
                    $request->file('image')->move('image_upload', $name);
                }


                $image_path= 'image_upload/'.$update->image;
                if(File::exists($image_path))
                {
                    File::delete($image_path);
                }
            $updated=$update->fill($requested_data)->save();
            if($updated)
            {
                Toastr::success('Data Updated Successfully','Success!!',['positionClass'=>'toast-top-right']);
            }
            else
            {
                Toastr::error('Something Went Wrong','Error!!',['positionClass'=>'toast-top-right']);
            }
            return back();
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
         $for_image_data= SupplierModel::where('supplier_id',$id)->first();
         $image_path = "image_upload/".$for_image_data->image; 

         if(File::exists($image_path)) {
                File::delete($image_path);
            }

        $deleted=$for_image_data->delete();
            

        if($deleted)
        {
           
            Toastr::success('Data Deleted Successfully','Success!!',['positionClass'=>'toast-top-right']);

        }
        else
        {
            Toastr::error('Something Went Wrong','Error!!',['positionClass'=>'toast-top-right']);
        }
        return back();
    }

    public function ajax_data(Request $request)
    {
        return SupplierModel::where('supplier_id',$request->edit_id)->first();
    }
}
