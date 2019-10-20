<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryModel;
use App\SubCategoryModel;
use Toastr;
use Validator;
use Redirect;
class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category_name_data= CategoryModel::all();
        $sub_category_data= SubCategoryModel::join('category_table',"sub_category.category_name","=","category_table.id")->orderBy('sub_category.created_at','desc')->get();
        return view('sub_category',['category_name_data'=>$category_name_data,'sub_category_data'=>$sub_category_data]);
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
        $sub_category= new SubCategoryModel;
        $validate=Validator::make($request->all(),$sub_category->validation());
        if($validate->fails())
        {
            return back()->withErrors($validate);
        }
        else
        {
            $inserted=$sub_category->fill($request->all())->save();
            if($inserted)
            {
                Toastr::success('Data inserted Successfully','Success!!',['positionClass'=>'toast-top-right']);
            }
            else
            {
                Toastr::error('Something Went Wrong','Error!!',['positionClass'=>'toast-top-right']);
            }
            
        }
        
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $status_data=SubCategoryModel::find($id);
        if($status_data->sub_category_status=='0')
        {
            $status_data->update(['sub_category_status'=>'1']);
            Toastr::success('Status Changed Successfully','Success!!',['positionClass'=>'toast-top-right']);
        }
        else
        {
            $status_data->update(['sub_category_status'=>'0']);
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
        $update_data=SubCategoryModel::findOrFail($id);
        $update_data->fill($request->all())->save();
        Toastr::success('Data Updated Successfully','Success!!',['positionClass'=>'toast-top-right']);
        return Redirect::to('/sub_category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($sub_category_id)
    {
        $deleted=SubCategoryModel::find($sub_category_id)->delete();
        if($deleted)
        {
            Toastr::success('Data Deleted Successfully','Success!!',['positionClass'=>'tost toast-top-right']);
        }
        else
        {
            Toastr::error('Something Went wrong','Error!!',['positionClass'=>'tost toast-top-right']);
        }
        return back();
    }

    public function ajax_data(Request $request)
    {
        $main_data=SubCategoryModel::join('category_table',"sub_category.category_name","=","category_table.id")
        ->where('sub_category_id',$request->edit_id)
        ->first();
        $category_name_data=CategoryModel::all();
        return [$main_data,$category_name_data];

    }
}
