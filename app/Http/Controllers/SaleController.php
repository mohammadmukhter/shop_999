<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductModel;
use App\StockModel;
use App\VatModel;
use App\DiscountModel;
use App\SaleModel;
use App\SaleTransactionModel;
use App\SaleIndividualProductModel;
use App\CustomerModel;

use Toastr;
use Validator;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        public function sale_create(Request $request)
        {   $customer_data=CustomerModel::all();

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
          
            return view('sale_create',['product_data'=>$product_data,'stock_data'=>$stock_data,'customer_data'=>$customer_data]);
        }

        public function sale_transaction()
        {
            $sale_transaction=SaleTransactionModel::join('customer','sale_transaction.customer_id','=','customer.customer_id')->select('sale_transaction.*','customer.customer_name')->orderBy('sale_transaction.created_at','desc')->get();
            return view('sale_transaction',['sale_transaction'=>$sale_transaction]);
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
        $sale= new SaleModel;
        $validate=Validator::make($request->all(),$sale->Validation());
        if($validate->fails())
        {
            return back()->withErrors($validate);
        }
        else
        {

            $sale_inv=SaleModel::orderBy('created_at','desc')->pluck('sale_invoice_code')->first();
            $sale_inv=preg_replace('/[^0-9]/','',$sale_inv);

            if($sale_inv == null)
            {
                 $uniq= 100000;
            }
            else
            {
                $uniq= $sale_inv+1;
            }
            $sale_invoice_code = 'SI-'.$uniq;

            $msg=0;
            for($i=0; $i<count($request->product_id); $i++)
            {
                $stock_count=StockModel::where('product_id',$request->product_id[$i])->get();
                if(count($stock_count)<$request->sale_quantity[$i])
                {
                    Toastr::error('Out of Stock','error!!',['positionClass'=>'toast-top-right']);
                    return back();
                }
                elseif($request->sale_quantity[$i] != 0 && $request->sale_paid != null)
                {
                    
                    $sale= new SaleModel;
                    $sale->sale_invoice_code= $sale_invoice_code;
                    $sale->customer_id= $request->customer_id;
                    $sale->product_id= $request->product_id[$i];
                    $sale->product_code= $request->product_code[$i];
                    $sale->sale_quantity= $request->sale_quantity[$i];
                    $sale->sale_unit_price= $request->sale_unit_price[$i];
                    $sale->sale_vat= $request->sale_vat[$i];
                    $sale->sale_vat_amount= $request->sale_vat_amount[$i];
                    $sale->sale_discount= $request->sale_discount[$i];
                    $sale->sale_discount_amount= $request->sale_discount_amount[$i];
                    $sale->sale_sub_total= $request->sale_sub_total[$i];
                    $sale->save();
                    $msg=1;
                }
                else
                {
                    $msg=2;
                }

            }
            if($msg==1)
            {
                Toastr::success('Sale Successfully','success!!',['positionClass'=>'toast-top-right']);
                
            }
            else
            {
                Toastr::error('Something went wrong','error!!',['positionClass'=>'toast-top-right']);
                return back();
            }




            $sale_transaction= new SaleTransactionModel;
            $st_validate=Validator::make($request->all(),$sale_transaction->Validation());
            if($st_validate->fails())
            {
                return back()->witherrors($st_validate);
            }
            else
            {
                if($request->sale_due > 0 && $request->sale_change==0)
                {
                    $st_status=0;
                }
                else
                {
                    $st_status=1;
                }
                
                $sale_transaction->customer_id= $request->customer_id;
                $sale_transaction->sale_invoice_code= $sale_invoice_code;
                $sale_transaction->sale_total_price= $request->sale_total_price;
                $sale_transaction->total_sale_discount= $request->total_sale_discount;
                $sale_transaction->total_sale_vat= $request->total_sale_vat;
                $sale_transaction->sale_net_total= $request->sale_net_total;
                $sale_transaction->sale_payment_method= $request->sale_payment_method;
                $sale_transaction->sale_paid= $request->sale_paid;
                $sale_transaction->sale_due= $request->sale_due;
                $sale_transaction->sale_change= $request->sale_change;
                $sale_transaction->sale_transaction_status= $st_status;
                $sale_t=$sale_transaction->save();

                if($sale_t)
                {
                    Toastr::success('Transaction Successfully','success!!',['positionClass'=>'toast-top-right']);
                }
            }
            


            for($i=0; $i<count($request->product_id); $i++)
            {
                $stock_d=StockModel::where('product_id',$request->product_id[$i])->orderBy('created_at','asc')->whereIn('stock_status',['1','2'])->get();
                

                $loop_number=$request->sale_quantity[$i];
                for($j=0; $j<$loop_number; $j++)
                {
                    
                    $sale_i_p= new SaleIndividualProductModel;
                    $sale_i_p->sale_invoice_code=$sale_invoice_code;
                    $sale_i_p->stock_id=$stock_d[$j]['stock_id'];
                    $sale_i_p->stock_code=$stock_d[$j]['stock_code'];
                    $sale_i_p->product_id=$request->product_id[$i];
                    $sale_i_p->product_code=$request->product_code[$i];
                    $sale_i_p->sale_individual_product_status=1;
                    $sale_i_p->save();

                    $stock_s_update= new StockModel;
                    $stock_s_update->where('stock_code',$stock_d[$j]['stock_code'])->update(['stock_status'=>0]);

                    $msg=11;
                }     
                    
            }
            if($msg==11)
            {
                Toastr::success('Sale Added Successfully','success!!',['positionClass'=>'toast-top-right']);
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
    public function show($sale_invoice_code)
    {
        $data['sale_transaction_data']=SaleTransactionModel::join('customer','sale_transaction.customer_id','=','customer.customer_id')->where('sale_transaction.sale_invoice_code',$sale_invoice_code)->first();

        $data['sale_data']=SaleModel::join('product','sale.product_id','=','product.product_id')->where('sale.sale_invoice_code',$sale_invoice_code)->get();

        return view('sale_transaction_details',$data);
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
        $data['stock_array']=StockModel::where('product_id',$request->p_id)->whereIn('stock_status',['1','2'])->count();
        $data['vat_array']=ProductModel::join('vat','product.product_id','=','vat.product_id')->where('product.product_id',$request->p_id)->select('vat.*')->first();
        
        $data['discount_array']=ProductModel::join('discount','product.product_id','=','discount.product_id')->where('product.product_id',$request->p_id)->select('discount.*')->first();
       
        return $data;
    }

    public function s_invoice($sale_invoice_code)
    {
        return view('sale_invoice');
    }
}
