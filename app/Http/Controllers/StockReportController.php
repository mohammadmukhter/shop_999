<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\StockModel;
use App\ProductModel;

class StockReportController extends Controller
{
    public function index()
    {
    	$products='';
        $stock_data=StockModel::all();
        $get_stock=$stock_data->pluck('product_id')
            ->unique()->toArray();
        $product_name=ProductModel::whereIn('product_id',$get_stock)->get();
    	return view('stock_report',['products'=>$products,'product_name'=>$product_name]);
    }

    public function show(Request $Request)
    {	
        
        if($Request->category_name)
        {
            return 'Ok';
        }
        elseif($Request->product_name)
        {

            $stock_data=StockModel::all();
            $get_stock=$stock_data->pluck('product_id')
            ->unique()->toArray();
            $product_name=ProductModel::whereIn('product_id',$get_stock)->get();

            $stock_product=StockModel::where('product_id',$Request->product_name)->get()->toArray();
            $get_stock_product=collect($stock_product)->pluck('product_id')
            ->unique()->toArray();
            $products=ProductModel::whereIn('product_id',$get_stock_product)
            ->get();
            
            return view('stock_report',['products'=>$products,'stock_product'=>$stock_product,'product_name'=>$product_name]);
        }
        elseif($Request->product_code)
        {
            $stock_data=StockModel::all();
            $get_stock=$stock_data->pluck('product_id')
            ->unique()->toArray();
            $product_name=ProductModel::whereIn('product_id',$get_stock)
            ->get();

            $stock_product=StockModel::where('product_code',$Request->product_code)->get()->toArray();
            $get_stock_product=collect($stock_product)->pluck('product_code')
            ->unique()->toArray();
            $products=ProductModel::whereIn('product_code',$get_stock_product)
            ->get();

            return view('stock_report',['products'=>$products,'stock_product'=>$stock_product,'product_name'=>$product_name]);
        }
        else
        {
            $stock_data=StockModel::all();
            $stock_product=StockModel::all()->toArray();
            $get_stock_product=collect($stock_product)->pluck('product_id')
            ->unique()->toArray();
            $products=ProductModel::whereIn('product_id',$get_stock_product)
            ->get();
            $product_name=ProductModel::whereIn('product_id',$get_stock_product)->get();
            return view('stock_report',['products'=>$products,'stock_product'=>$stock_product,'product_name'=>$product_name]);
        }

    }
}
