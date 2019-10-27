<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SupplierModel;
use App\ProductModel;
use App\VatModel;
use App\DiscountModel;
use App\PurchaseModel;
use App\PurchaseTransactionModel;
use App\StockModel;
use Validator;
use Toastr;
use Redirect;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        public function pur_create()
        {
            $supplier_data=SupplierModel::all();
            $product_data=ProductModel::all();

            $purchase_voucher_code= 'PVC'. time();

            return view('purchase_create',['supplier_data'=>$supplier_data,'product_data'=>$product_data,'purchase_voucher_code'=>$purchase_voucher_code]);
        }


    public function index()
    {
        $purchase_transaction_data=PurchaseTransactionModel::join('supplier','purchase_transaction.supplier_id','=','supplier.supplier_id')->select('supplier.supplier_name','purchase_transaction.*')->orderby('created_at','desc')->get();
        return view('purchase_list',['purchase_transaction_data'=>$purchase_transaction_data]);
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

        $purchase=new PurchaseModel;


        $purchase_validate=Validator::make($request->all(),$purchase->Validation());
        if($purchase_validate->fails())
        {
            return back()->withErrors($purchase_validate);
        }
        else
        {
            
            $msg=0;
            for($i=0; $i<count($request->product_id); $i++)
            {

                if($request->purchase_quantity[$i]!=0)
                {

                    $purchase=new PurchaseModel;
                    $purchase->supplier_id = $request->supplier_id;
                    $purchase->purchase_voucher_code = $request->purchase_voucher_code;
                    $purchase->product_id = $request->product_id[$i];
                    $purchase->product_code = $request->product_code[$i];
                    $purchase->purchase_unit_price = $request->purchase_unit_price[$i];
                    $purchase->purchase_quantity = $request->purchase_quantity[$i];
                    $purchase->production_date = $request->production_date[$i];
                    $purchase->expired_date = $request->expired_date[$i];
                    $purchase->purchase_vat = $request->purchase_vat[$i];
                    $purchase->purchase_vat_amount = $request->vat_hidden[$i];
                    $purchase->purchase_discount = $request->purchase_discount[$i];
                    $purchase->purchase_discount_amount = $request->discount_hidden[$i];
                    $purchase->purchase_sub_total = $request->purchase_sub_total[$i];
                    $p_inserted=$purchase->save();
                    $msg=1;
                }
                else
                {
                    $msg=2;
                }
            }

            if($msg==1)
            {
                Toastr::success('Purchase Successfully','Success!!',['positionClass'=>'toast-top-right']);

               
            }
            else if($msg==2)
            {
               Toastr::error('Please Select Quantity For All','Error!!',['positionClass'=>'toast-top-right']); 
                return back();
            }
            else
            {
                Toastr::error('Something Went Wrong','Error!!',['positionClass'=>'toast-top-right']); 
                 return back(); 
            }

        }



        $purchase_transaction= new PurchaseTransactionModel;
        $purchase_transaction_validate=Validator::make($request->all(),$purchase_transaction->Validation());
        if($purchase_transaction_validate->fails())
        {
            return back()->withErrors($purchase_transaction_validate);
        }
        else
        {
            if($request->purchase_due > 0 && $request->purchase_change==0)
            {
                $t_status=0;
            }
            else
            {
                $t_status=1;
            }

            $purchase_transaction->supplier_id = $request->supplier_id;
            $purchase_transaction->purchase_voucher_code = $request->purchase_voucher_code;
            $purchase_transaction->purchase_total_price = $request->purchase_total_price;
            $purchase_transaction->total_purchase_discount = $request->total_purchase_discount;
            $purchase_transaction->total_purchase_vat = $request->total_purchase_vat;
            $purchase_transaction->purchase_net_price = $request->purchase_net_price;
            $purchase_transaction->purchase_payment_method = $request->purchase_payment_method;
            $purchase_transaction->purchase_paid = $request->purchase_paid;
            $purchase_transaction->purchase_due = $request->purchase_due;
            $purchase_transaction->purchase_change = $request->purchase_change;
            $purchase_transaction->purchase_transaction_status = $t_status;
            $pt_inserted=$purchase_transaction->save();

            if($pt_inserted)
            {
                Toastr::success('Transaction Successfully','Success!!',['positionClass'=>'toast-top-right']);

            }
            else
            {
                Toastr::error('Something Went Wrong','Error!!',['positionClass'=>'toast-top-right']);
                return back();
            }
        }

        $stock= new StockModel;
        $stock_validate=Validator::make($request->all(),$stock->Validation());
        if($stock_validate->fails())
        {
            return back()->withErrors($stock_validate);
        }
        else
        {
            for($i=0; $i<count($request->product_id); $i++)
            {
                $loop_number=$request->purchase_quantity[$i];
                for($j=0; $j<$loop_number; $j++)
                {
                    $stock= new StockModel;
                    $stock->stock_code = time().'-'.$i.$j;
                    $stock->purchase_voucher_code = $request->purchase_voucher_code;
                    $stock->product_id = $request->product_id[$i];
                    $stock->product_code = $request->product_code[$i];
                    $stock->stock_status = 1;
                    $s_inserted=$stock->save();                       
                }
            }
            

                if($s_inserted)
                {
                    Toastr::success('Stock Inserted Successfully','Success!!',['positionClass'=>'toast-top-right']);
                }
                else
                {
                    Toastr::error('Something Went Wrong','Error!!',['positionClass'=>'toast-top-right']);
                    return back();
                }

        }
        return Redirect::to('/purchase_list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $purchase_data=PurchaseModel::join('product','purchase.product_id','=','product.product_id')->where('purchase.purchase_voucher_code',$id)->select('product.*','purchase.*')->get();
        $purchase_transaction_data= PurchaseTransactionModel::join('supplier','purchase_transaction.supplier_id','=','supplier.supplier_id')->where('purchase_transaction.purchase_voucher_code',$id)->select('purchase_transaction.*','supplier.*')->firstOrfail();

        return view('purchase_transaction_details',['purchase_data'=>$purchase_data,'id'=>$id,'purchase_transaction_data'=>$purchase_transaction_data]);
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
        //echo $request->data_id;
        $data['product_array']=ProductModel::where('product_id',$request->data_id)->first();
        $vat_array=ProductModel::join('vat','product.product_id','=','vat.product_id')->where('product.product_id',$request->data_id)->select('vat.*')->first();
        if($vat_array)
        {
            $data['vat_array']=$vat_array;
        }

        $discount_array=ProductModel::join('discount','product.product_id','=','discount.product_id')->where('product.product_id',$request->data_id)->select('discount.*')->first();
        if($discount_array)
        {
            $data['discount_array']=$discount_array;
        }

        return $data;
    }

}
