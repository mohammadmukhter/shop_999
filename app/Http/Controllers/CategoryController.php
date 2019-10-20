<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryModel;
use Validator;
use Toastr;
use Redirect;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category_data= CategoryModel::orderBy('created_at', 'desc')->get();
       $ip=\Request::ip();
        return view('category',['category_data'=>$category_data,'ip'=>$ip]);

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
        $category_model= new CategoryModel;
        $category_data_validate=Validator::make($request->all(),$category_model->validation());
        if($category_data_validate->fails())
        {
            return back()->withErrors($category_data_validate);
        }
        else
        {
            $inserted=$category_model->fill($request->all())->save();
            if($inserted)
            {
                Toastr::success('Data Inserted Successfully', 'Success!!', ["positionClass" => "toast-top-right"]);
            }
            else
            {
                Toastr::error('Something Went Wrong!', 'Failed!!', ["positionClass" => "toast-top-right"]);
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
        $data=CategoryModel::find($id);
        if($data->category_status=='0')
        {
            $data->update(['category_status'=>'1']);
            Toastr::success('Status Change Successfully','Success!!',['positionClass'=>'toast-top-right']);
        }
        else
        {
            $data->update(['category_status'=>'0']);
            Toastr::success('Status Change Successfully','Success!!',['positionClass'=>'toast-top-right']);
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
        $data=CategoryModel::find($id);
        return view('category_update',['data'=>$data]); 
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

        $update= new CategoryModel;
        $validate=Validator::make($request->all(),$update->validation());
        if($validate->fails())
        {
            return back()->withErrors($validate);
        }
        else
        {
            $updated=$update->find($id)->fill($request->all())->save();
            if($updated)
            {
                Toastr::success('Data Updated Successfully','Success!!',['positionClass'=>'toast-top-right']);
            }
            else
            {
                Toastr::error('Something Went Wrong','Success!!',['positionClass'=>'toast-top-right']);
            }
        }
        
        return Redirect::to('category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted=CategoryModel::find($id)->delete();
        if($deleted)
        {
            Toastr::success('Data Deleted Successfully','Success!!',['positionClass'=>'toast-top-right']);
        }
        else
        {
            Toastr::error('Something Went Wrong','Failed!!',['positionClass'=>'toast-top-right']);
        }
        return back();
    }
}
