<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UnitModel;
use Validator;
use Toastr;
use Redirect;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $unit_data=UnitModel::orderby('created_at','desc')->get();
        return view('unit',['unit_data'=>$unit_data]);
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
        $unit= new UnitModel;
        $validate=Validator::make($request->all(),$unit->Validation());
        if($validate->fails())
        {
            return back()->withErrors($validate);
        }
        else
        {
            $inserted=$unit->fill($request->all())->save();
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
        $status_data=UnitModel::find($id);
        if($status_data->unit_status=='0')
        {
            $status_data->update(['unit_status'=>'1']);
            Toastr::success('Status Changed Successfully','Success!!',['positionClass'=>'toast-top-right']);
        }
        else
        {
            $status_data->update(['unit_status'=>'0']);
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
        $update= UnitModel::find($id);
        $validate=Validator::make($request->all(),$update->Validation());
        if($validate->fails())
        {
            return back()->withErrors($validate);
        }
        else
        {
            $updated=$update->fill($request->all())->save();

            if($updated)
            {
                Toastr::success('Data Updated Successfully','Success!!',['positionClass'=>'toast-top-right']);
            }
            else
            {
                Toastr::error('Something Went Wrong','Error!!',['positionClass'=>'toast-top-right']);
            }
            return Redirect::To('/unit');
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
        $deleted=UnitModel::find($id)->delete();
        if($deleted)
        {
            Toastr::success('Data Deleted Successfully','Success',['positionClass'=>'toast-top-right']);
        }
        else
        {
            Toastr::success('Data Deleted Successfully','Success',['positionClass'=>'toast-top-right']);
        }     
        return back();
    }

    public function ajax_data(Request $request)
    {
        return $edit_data=UnitModel::where('unit_id',$request->edit_id)->first();
    }
}
