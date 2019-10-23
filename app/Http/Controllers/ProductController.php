<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryModel;
use App\SubCategoryModel;
use App\UnitModel;
use App\ProductModel;
use App\PriceVariationModel;
use Validator;
use Toastr;
use Arr;
use Redirect;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category_data= CategoryModel::all();
        // return response()->json($category_data);
        $unit_data= UnitModel::all();

        $product_data= ProductModel::join('category_table','product.category_id','=','category_table.id')->join('sub_category','product.sub_category_id','=','sub_category.sub_category_id')->join('unit','product.unit_id','=','unit.unit_id')
        ->select('product.*','category_table.*','sub_category.*','category_table.category_name As c_name','unit.*')
        ->orderby('product.created_at','desc')->get();
        
        return view("product",['category_data'=>$category_data,'unit_data'=>$unit_data,'product_data'=>$product_data]);
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

        

        $product= new ProductModel;


        $validate=Validator::make($request->all(),$product->Validation());
        if($validate->fails())
        {
            return back()->withErrors($validate);
        }
        else
        {

            if($product->PriceValidation($request->purchase_price, $request->sale_price))
            {
                 Toastr::error('Purchase price Cannot bigger than Sale Price','Error!!',['positionClass'=>'toast-top-right']);
                 return back();
            }
                $requested_data=$request->all();
                $requested_data=Arr::set($requested_data,'product_code',time());

                if($request->image)
                {
                    $file = $request->file('image');
                    $name = rand(111111111,999999999).'.'.$file->getClientOriginalExtension();
                    $requested_data=Arr::set($requested_data,'image',$name);
                    $request->file('image')->move("image_upload", $name);
                }

                $inserted=$product->fill($requested_data)->save();
                    

                if($inserted)
                {
                    Toastr::success('Data Inserted Successfully','Success!!',['positionClass'=>'toast-top-right']);
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

        $status=ProductModel::where('product_id',$id)->first();
        if($status->product_status=='0')
        {
            $updated=$status->update(['product_status'=>'1']);
            if($updated)
            {
                Toastr::success('Status Changed Successfully','Changed!!',['positionClass'=>'toast-top-right']);
            }
        }
        else
        {
            $updated=$status->update(['product_status'=>'0']);
            if($updated)
            {
                Toastr::success('Status Changed Successfully','Changed!!',['positionClass'=>'toast-top-right']);
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
       
        $data['edit_data']=ProductModel::join('category_table','product.category_id','=','category_table.id')->join('sub_category','product.sub_category_id','=','sub_category.sub_category_id')->join('unit','product.unit_id','=','unit.unit_id')->where('product_id',$id)->select('category_table.*','sub_category.*','product.*','unit.*','category_table.category_name As C_name')->first();


        $data['category_data']=CategoryModel::all();
        $data['sub_category_data']=SubCategoryModel::all();
        $data['unit_data']=UnitModel::all();

        //dd($data);
        

        return view('product_update',$data);
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
        $update= ProductModel::where('product_id',$id)->first();
        $price_variation_data= new PriceVariationModel;

        $validate=Validator::make($request->all(),$update->Validation());
        if($validate->fails())
        {
            return back()->withErrors($validate);
        }
        else
        {
            if($update->PriceValidation($request->purchase_price, $request->sale_price))
            {
                Toastr::error('Purchase price Cannot bigger than Sale Price','Error!!',['positionClass'=>'toast-top-right']);
                 return back();
            }
                $requested_data=$request->all();

                if($request->image)
                {
                    $file = $request->file('image');
                    $name = time().'.'.$file->getClientOriginalExtension();
                    $requested_data=Arr::set($requested_data,'image',$name);
                    $request->file('image')->move("image_upload", $name);
                }

                if($request->purchase_price != $update->purchase_price )
                {
                    $update->update(['last_purchase_price'=>$update->purchase_price]);
                }

                if($request->sale_price != $update->sale_price)
                {
                    $update->update(['last_sale_price'=>$update->sale_price]);
                    
                }
                if($request->purchase_price != $update->purchase_price || $request->sale_price != $update->sale_price )
                {
                    $price_variation_data->insert([
                        'product_id'=>$update->product_id,
                        'last_purchase_price'=>$update->purchase_price,
                        'last_sale_price'=>$update->sale_price,
                        'created_at'=> \Carbon\Carbon::now(),
                    ]);
                }

                if($request->iamge)
                {
                    $image_path= 'image_upload/'.$update->image;
                    if(File::exists($image_path))
                    {
                        File::delete($image_path);
                    }
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

            return Redirect::To('/product');
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

        $data=ProductModel::where('product_id',$id)->first();
            $image_path= 'image_upload/'.$data->image;
            if(File::exists($image_path))
            {
                File::delete($image_path);
            }
        $deleted=$data->delete();
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
       return SubCategoryModel::where('category_name',$request->category_id)
       ->get();       
    }
}


