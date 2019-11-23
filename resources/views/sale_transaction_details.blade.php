@extends('backend.backend')
@section('main_section')
<div style="background: #373837; color: #fff; padding: 10px 10px; font-size: 20px; font-weight: bold;">Sale Details <span style="float: right; font-size: 14px; font-weight: bold; margin-top: 10px; color: red;">{{$sale_transaction_data->sale_invoice_code}}</span></div>
<div class="panel" style="background: #DFF0E3">
	<div class="row">
		<div class="col-md-3">
				<div class="panel-head" style="text-align: center; font-weight: bold; background: black; color: #fff; box-shadow: -1px 3px 18px -1px rgba(0,0,0,0.75);">
				Customer Information
				</div>
				<div class="panel-body" style="border: 1px solid black; height: 150px;">
					<table>
						<tr style="line-height: 1.8;">
							<td style="font-weight: bold; color: black;">Customer Name</td>
							<td style="font-weight: bold; color: black;">:</td>
							<td style="padding-left: 15px;">{{$sale_transaction_data->customer_name}}</td>
						</tr>

						<tr style="line-height: 1.8;">
							<td style="font-weight: bold; color: black;">Phone</td>
							<td style="font-weight: bold; color: black;">:</td>
							<td style="padding-left: 15px;">{{$sale_transaction_data->customer_phone}}</td>
						</tr>

						<tr style="line-height: 1.8;">
							<td style="font-weight: bold; color: black;">Address</td>
							<td style="font-weight: bold; color: black;">:</td>
							<td style="padding-left: 15px;">{{$sale_transaction_data->customer_address}}</td>
						</tr>
					</table>
				</div>	
		</div>	

		<div class="col-md-3">
			<div class="panel-head" style="text-align: center; font-weight: bold; background: black; color: #fff; box-shadow: -1px 3px 18px -1px rgba(0,0,0,0.75);">
				Invoice Information
				</div>
				<div class="panel-body" style="border: 1px solid black; height: 150px;">
					<table>
						<tr style="line-height: 1.8;">
							<td style="font-weight: bold; color: black;">Invoice ID</td>
							<td style="font-weight: bold; color: black;">:</td>
							<td style="padding-left: 15px;">{{$sale_transaction_data->sale_invoice_code}}</td>
						</tr>

						<tr style="line-height: 1.8;">
							<td style="font-weight: bold; color: black;">Date</td>
							<td style="font-weight: bold; color: black;">:</td>
							<td style="padding-left: 15px;">{{$sale_transaction_data->created_at->format('m/d/Y')}}</td>
						</tr>

						<tr style="line-height: 1.8;">
							<td style="font-weight: bold; color: black;">Time</td>
							<td style="font-weight: bold; color: black;">:</td>
							<td style="padding-left: 15px;">{{$sale_transaction_data->created_at->format('h:m:s')}}</td>
						</tr>
					</table>
				</div>
		</div>	

		<div class="col-md-3">
			<div class="panel-head" style="text-align: center; font-weight: bold; background: black; color: #fff; box-shadow: -1px 3px 18px -1px rgba(0,0,0,0.75);">
				Transaction Information
				</div>
				<div class="panel-body" style="border: 1px solid black; height: 150px;">
					<table>
						<tr style="line-height: 1.8;">
							<td style="font-weight: bold; color: black;">Total Price</td>
							<td style="font-weight: bold; color: black;">:</td>
							<td style="padding-left: 15px;">{{$sale_transaction_data->sale_total_price}}</td>
						</tr>

						<tr style="line-height: 1.8;">
							<td style="font-weight: bold; color: black;">Net Price</td>
							<td style="font-weight: bold; color: black;">:</td>
							<td style="padding-left: 15px;">{{$sale_transaction_data->sale_net_total}}</td>
						</tr>

						<tr style="line-height: 1.8;">
							<td style="font-weight: bold; color: black;">Paid</td>
							<td style="font-weight: bold; color: black;">:</td>
							<td style="padding-left: 15px;">{{$sale_transaction_data->sale_paid}}</td>
						</tr>


						<tr style="line-height: 1.8;">
							<td style="font-weight: bold; color: black;">Due</td>
							<td style="font-weight: bold; color: black;">:</td>
							<td style="padding-left: 15px;">
								@if($sale_transaction_data->sale_due > 0 )
								<span style="color: red; font-weight: bold;">{{$sale_transaction_data->sale_due}}</span>
								@else
								<span style="color: green; font-weight: bold;">{{$sale_transaction_data->sale_due}}</span>
								@endif
							</td>
						</tr>


						<tr style="line-height: 1.8;">
							<td style="font-weight: bold; color: black;">Change</td>
							<td style="font-weight: bold; color: black;">:</td>
							<td style="padding-left: 15px;">{{$sale_transaction_data->sale_change}}</td>
						</tr>
					</table>
				</div>
		</div>

		<div class="col-md-3">
			<div class="panel-head" style="text-align: center; font-weight: bold; background: black; color: #fff; box-shadow: -1px 3px 18px -1px rgba(0,0,0,0.75);">
				 Vat & Discount
				</div>
				<div class="panel-body" style="border: 1px solid black; height: 150px;">
					<table>
						<tr style="line-height: 1.8;">
							<td style="font-weight: bold; color: black;">Total Vat</td>
							<td style="font-weight: bold; color: black;">:</td>
							<td style="padding-left: 15px;">{{$sale_transaction_data->total_sale_vat}}</td>
						</tr>

						<tr style="line-height: 1.8;">
							<td style="font-weight: bold; color: black;">Total Discount</td>
							<td style="font-weight: bold; color: black;">:</td>
							<td style="padding-left: 15px;">{{$sale_transaction_data->total_sale_discount}}</td>
						</tr>
					</table>
				</div>
		</div>

		<div class="col-md-12">
			<div class="panel-head" style="text-align: center; margin-top: 15px; font-weight: bold; background: black; color: #fff; box-shadow: -1px 3px 18px -1px rgba(0,0,0,0.75);">
				 Product Details
				</div>
				<div class="panel-body" style="border: 1px solid black; min-height: 150px;">
					<table class="table table-bordered" style="text-align: center;">
						<thead>
							<tr style="font-weight: bold;">
								<td>Sl</td>
								<td>Product Name</td>
								<td>Product Per price</td>
								<td>Quantity</td>
								<td>Sub Total Price</td>
							</tr>
						</thead>
						<tbody>
							@foreach($sale_data as $key=> $sale_data_value)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$sale_data_value->product_name}}</td>
								<td>{{$sale_data_value->sale_unit_price}}</td>
								<td>{{$sale_data_value->sale_quantity}}</td>
								<td>{{$sale_data_value->sale_sub_total}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
		</div>

		<div class="col-md-6">
			<div class="panel-head" style="text-align: center; margin-top: 15px; font-weight: bold; background: black; color: #fff; box-shadow: -1px 3px 18px -1px rgba(0,0,0,0.75);">
				 Product Wise Discount
				</div>
				<div class="panel-body" style="border: 1px solid black; height: 150px;">
					<table class="table table-bordered" style="text-align: center;">
						<thead>
							<tr style="font-weight: bold;">
								<td>Product Name</td>
								<td>Discount</td>
								<td>Discount Amount</td>
							</tr>
						</thead>
						<tbody>
							@foreach($sale_data as $d_data)
							<tr>
								@if($d_data->sale_discount != 0)
									<td>{{$d_data->product_name}}</td>
									<td>{{$d_data->sale_discount}}</td>
									<td>{{$d_data->sale_discount_amount}}</td>
								@endif
							</tr>
							@endforeach

							@if($sale_transaction_data->total_sale_discount==0)
								<tr>
									<td colspan="3"> No Data Found </td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>
		</div>

		<div class="col-md-6">
			<div class="panel-head" style="text-align: center; margin-top: 15px; font-weight: bold; background: black; color: #fff; box-shadow: -1px 3px 18px -1px rgba(0,0,0,0.75);">
				 Product Wise Vat
				</div>
				<div class="panel-body" style="border: 1px solid black; min-height: 150px;">
					<table class="table table-bordered" style="text-align: center;">
						<thead>
							<tr style="font-weight: bold;">
								<td>Product Name</td>
								<td>Vat</td>
								<td>Vat Amount</td>
							</tr>
						</thead>
						<tbody>
							@foreach($sale_data as $v_data)
							<tr>
								@if($v_data->sale_vat != 0)
									<td>{{$v_data->product_name}}</td>
									<td>{{$v_data->sale_vat}}</td>
									<td>{{$v_data->sale_vat_amount}}</td>
								@endif
							</tr>
							@endforeach

							@if($sale_transaction_data->total_sale_vat==0)
								<tr>
									<td colspan="3"> No Data Found </td>
								</tr>
							@endif

						</tbody>
					</table>
				</div>
		</div>

		<div class="col-md-12" style="text-align: center; margin-top: 20px;">
			{{Form::open(['url'=>'/sale_transaction','method'=>'get'])}}
			<i style="color: red; font-size: 15px;" class="fa fa-caret-left"></i>&nbsp;
			{{Form::submit('Back',['class'=>'btn btn-danger'])}}
			{{Form::close()}}
			
		</div>

	</div>
</div>

@endsection