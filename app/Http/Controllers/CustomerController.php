<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomerModel;
use Validator;
use Toastr;
use Arr;
use File;
use Redirect;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer_data=CustomerModel::orderBy('created_at','desc')->get();
        return view('customer',['customer_data'=>$customer_data]);
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
        $customer_data= new CustomerModel;
        $validate=Validator::make($request->all(),$customer_data->Validation());
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
            $inserted=$customer_data->fill($requested_data)->save();
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
        $status_data=CustomerModel::where('customer_id',$id)->firstOrFail();
        if($status_data->customer_status=='0')
        {
            $inserted=$status_data->update(['customer_status'=>'1']);
            if($inserted)
            {
                Toastr::success('Status Changed Successfully','Success!!',['positionClass'=>'toast-top-right']);
            }
            else
            {
                Toastr::error('Somehting Went Wrong','Error!!',['positionClass'=>'toast-top-right']);
            }
        }
        else
        {
            $inserted=$status_data->update(['customer_status'=>'0']);
            if($inserted)
            {
                Toastr::success('Status Changed Successfully','Success!!',['positionClass'=>'toast-top-right']);
            }
            else
            {
                Toastr::error('Somehting Went Wrong','Error!!',['positionClass'=>'toast-top-right']);
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
        $update=CustomerModel::where('customer_id',$id)->firstOrFail();
        $validate=Validator::make($request->all(),$update->Validation());
        if($validate->fails())
        {
            return back()->withErrors($validate);
        }
        else
        {
            $requested_data= $request->all();

                if($request->image)
                {
                    $file=$request->file('image');
                    $name= time().'.'.$file->getClientOriginalExtension();
                    $requested_data=Arr::set($requested_data,'image',$name);

                    $file->move('image_upload',$name);
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
            return Redirect::to('/customer');
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
        $data=CustomerModel::where('customer_id',$id)->firstOrFail();
        
            $image_path='image_upload/'.$data->image;
            if(File::exists($image_path))
            {
                File::delete($image_path);
            }

        $deleted=$data->delete();
        if($deleted)
        {
            Toastr::success('Data Deleted Successfully','Success!',['positionClass'=>'toast-top-right']);
        }
        else
        {
            Toastr::error('Something Went Wrong','Error!!',['positionClass'=>'toast-top-right']);
        }
        return back();
    }

    public function ajax_data(Request $request)
    {
        return CustomerModel::where('customer_id',$request->edit_id)->firstOrFail();
    }
}
