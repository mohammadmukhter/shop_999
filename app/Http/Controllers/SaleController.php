<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductModel;
use App\StockModel;
use App\VatModel;
use App\DiscountModel;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        public function sale_create(Request $request)
        {
            $stock_data=StockModel::all()->toArray();
            $stock_ids=collect($stock_data)->pluck('product_id')->unique()->toArray();
            if($request->filter=="filter")
            {
                $product_data=ProductModel::where(function($product_data) use ($request){
                    $product_data->where('product_name','LIKE','%'.$request->product_search.'%')
                                 ->orWhere('product_code',$request->product_search);
                })->whereIn('product_id',$stock_ids)->get();
            }
            else
            {
                $product_data=ProductModel::whereIn('product_id',$stock_ids)->get();
            }
          
            return view('sale_create',['product_data'=>$product_data,'stock_data'=>$stock_data]);
        }

        public function sale_transaction()
        {
            return view('sale_transaction');
        }

    public function index()
    {
        return view('sale_list');
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
        $data['product_array']=ProductModel::where('product_id',$request->p_id)->first();
        $data['vat_array']=ProductModel::join('vat','product.product_id','=','vat.product_id')->where('product.product_id',$request->p_id)->select('vat.*')->first();
        
        $data['discount_array']=ProductModel::join('discount','product.product_id','=','discount.product_id')->where('product.product_id',$request->p_id)->select('discount.*')->first();
       
        return $data;
    }
}
