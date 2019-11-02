@extends('backend.backend')
@section('main_section')

<div style="background: black; color: white; padding: 10px 5px; font-weight: bold; text-align: center; font-size: 20px; padding-left: 180px;">

	Purchase Transaction Details
	<p style="font-size: 15px; float: right; margin-top: 10px;"> VOUCHER&nbsp;: <span style="color: red; margin-right: 15px; text-shadow: 1px 1px 2px #CC6A6A;">	&nbsp;{{$id}}</span> </p>
</div>


<div class="panel">
	<div class="panel-body" style="background: #7B7C7B">

		<div class="row">
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="panel-layout">
					<div class="panel-box" style="background:#F2EEEE; height: 150px;box-shadow: -1px 3px 18px -1px rgba(0,0,0,0.75);">
						<div class="panel-content" style="background:#99999A; color: black; font-weight: bold; text-align: center; padding: 5px 0px;">Supplier Information</div>
						<div class="panel-content" style="padding: 15px 10px;">
							<table>
								<tr style="padding: 10px 0px;">
									<td style="font-weight: bold; color: black;">Name</td>
									<td  style="font-weight: bold; color: black;">:</td>
									<td style="padding-left: 15px;">{{$purchase_transaction_data->supplier_name}}</td>
								</tr>
								<tr style="padding: 10px 0px;">
									<td  style="font-weight: bold; color: black;">Comapny</td>
									<td  style="font-weight: bold; color: black;">:</td>
									<td style="padding-left: 15px;">{{$purchase_transaction_data->company_name}}</td>
								</tr>
								<tr style="padding: 10px 0px;">
									<td  style="font-weight: bold; color: black;">Phone</td>
									<td  style="font-weight: bold; color: black;">:</td>
									<td style="padding-left: 15px;">{{$purchase_transaction_data->supplier_phone}}</td>
								</tr>
								<tr style="padding: 10px 0px;">
									<td  style="font-weight: bold; color: black;">Address</td>
									<td  style="font-weight: bold; color: black;">:</td>
									<td style="padding-left: 15px;">{{$purchase_transaction_data->supplier_address}}</td>
								</tr>

							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="panel-layout">
					<div class="panel-box" style="background:#F2EEEE; height: 150px;box-shadow: -1px 3px 18px -1px rgba(0,0,0,0.75);">
						<div class="panel-content" style="background:#99999A; color: black; font-weight: bold; text-align: center; padding: 5px 0px; ">Total Vat and Discount</div>
						<div class="panel-content" style="padding: 15px 10px;">
							<table>
								<tr style="padding: 10px 0px;">
									<td style="font-weight: bold; color: black;">Totol Vat Amount</td>
									<td  style="font-weight: bold; color: black;">:</td>
									<td style="padding-left: 15px;">{{$purchase_transaction_data->total_purchase_vat}}</td>
								</tr>
								
								<tr style="padding: 10px 0px;">
									<td  style="font-weight: bold; color: black;">Total Discount Amount</td>
									<td  style="font-weight: bold; color: black;">:</td>
									<td style="padding-left: 15px;">{{$purchase_transaction_data->total_purchase_discount}}</td>
								</tr>

							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="panel-layout">
					<div class="panel-box" style="background:#F2EEEE; height: 150px;box-shadow: -1px 3px 18px -1px rgba(0,0,0,0.75);">
						<div class="panel-content" style="background:#99999A; color: black; font-weight: bold; text-align: center; padding: 5px 0px;">Transaction</div>
						<div class="panel-content" style="padding: 15px 10px;">
							<table>
								
								<tr style="padding: 10px 0px;">
									<td style="font-weight: bold; color: black;"> Net Total Price</td>
									<td  style="font-weight: bold; color: black;">:</td>
									<td style="padding-left: 15px;">{{$purchase_transaction_data->purchase_net_price}}</td>
								</tr>
								
								<tr style="padding: 10px 0px;">
									<td  style="font-weight: bold; color: black;"> Total Paid </td>
									<td  style="font-weight: bold; color: black;">:</td>
									<td style="padding-left: 15px;">{{$purchase_transaction_data->purchase_paid}}</td>
								</tr>

								<tr style="padding: 10px 0px;">
									<td  style="font-weight: bold; color: black;"> Due </td>
									<td  style="font-weight: bold; color: black;">:</td>
									<td style="padding-left: 15px;">{{$purchase_transaction_data->purchase_due}}</td>
								</tr>
								<tr style="padding: 10px 0px;">
									<td  style="font-weight: bold; color: black;"> Change </td>
									<td  style="font-weight: bold; color: black;">:</td>
									<td style="padding-left: 15px;">{{$purchase_transaction_data->purchase_change}}</td>
								</tr>

							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row" style="padding-top: 20px;">
			<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
				<div class="panel-box" style="background:#F2EEEE; height: 100%;box-shadow: -1px 3px 18px -1px rgba(0,0,0,0.75);">
						<div class="panel-content" style="background:#99999A; color: black; font-weight: bold; text-align: center; padding: 5px 0px;">Product Details</div>
							<table class="table table-bordered">
								<thead style="background: #D5CBCA;">
									<tr style="padding: 10px 0px;">
										<td style="font-weight: bold; color: black;">Sl</td>
										<td style="font-weight: bold; color: black;">Product Name</td>
										<td style="font-weight: bold; color: black;">Product Code</td>
										<td style="font-weight: bold; color: black;">Product Per Price</td>
										<td style="font-weight: bold; color: black;">Quantity</td>
										<td style="font-weight: bold; color: black;">Total Price</td>
										<td style="font-weight: bold; color: black;">Expired Date</td>
									</tr>
								</thead>

								<tbody>
									@foreach($purchase_data as $key=> $p_data)
									<tr>
										<td>{{$key+1}}</td>
										<td>{{$p_data->product_name}}</td>
										<td>{{$p_data->product_code}}</td>
										<td>{{$p_data->purchase_unit_price}}</td>
										<td>{{$p_data->purchase_quantity}}</td>
										<td>{{$p_data->purchase_sub_total}}</td>
										<td>{{$p_data->expired_date}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
				</div>
			</div>
		</div>

		<div class="row" style="padding-top: 20px;">
			<div class="col-md-6 col-sm-12 col-xs-12" style="text-align: center;">
				<div class="panel-box" style="background:#F2EEEE; height: 100%; box-shadow: -1px 3px 18px -1px rgba(0,0,0,0.75);">
						<div class="panel-content" style="background:#99999A; color: black; font-weight: bold; text-align: center; padding: 5px 0px;">Products Vat Information</div>
							<table class="table table-bordered">
								<thead style="background: #D5CBCA;">
									<tr style="padding: 10px 0px;">
										<td style="font-weight: bold; color: black;">Product Name</td>
										<td style="font-weight: bold; color: black;">Vat (%)</td>
										<td style="font-weight: bold; color: black;">Total Vat Amount</td>
										<td style="font-weight: bold; color: black;">
									</tr>
								</thead>

								<tbody>
									
									@foreach($purchase_data as $v_data)
										@if($v_data->purchase_vat != 0)
										<tr>
											<td>{{$v_data->product_name}}</td>
											<td>{{$v_data->purchase_vat}}</td>
											<td>{{$v_data->purchase_vat_amount}}</td>
										</tr>
										@endif
									@endforeach

									@if($purchase_transaction_data->total_purchase_vat==0)
									<tr>
										<td colspan="3"> No Data Found </td>
									</tr>
									@endif
									
								</tbody>
							</table>
				</div>
			</div>
			<div class="col-md-6 col-sm-12 col-xs-12" style="text-align: center;">
				<div class="panel-box" style="background:#F2EEEE; height: 100%;box-shadow: -1px 3px 18px -1px rgba(0,0,0,0.75);">
						<div class="panel-content" style="background:#99999A; color: black; font-weight: bold; text-align: center; padding: 5px 0px;">Products Vat Information</div>
							<table class="table table-bordered">
								<thead style="background: #D5CBCA;">
									<tr style="padding: 10px 0px;">
										<td style="font-weight: bold; color: black;">Product Name</td>
										<td style="font-weight: bold; color: black;">Discount (%)</td>
										<td style="font-weight: bold; color: black;">Total Discount Amount</td>
										<td style="font-weight: bold; color: black;">
									</tr>
								</thead>

								<tbody>
									
									@foreach($purchase_data as $d_data)
										@if($d_data->purchase_discount != 0)
										<tr>
											<td>{{$d_data->product_name}}</td>
											<td>{{$d_data->purchase_discount}}</td>
											<td>{{$d_data->purchase_discount_amount}}</td>
										</tr>
										@endif
									@endforeach

									@if($purchase_transaction_data->total_purchase_discount==0)
									<tr>
										<td colspan="3"> No Data Found </td>
									</tr>
									@endif

								</tbody>
							</table>
				</div>
			</div>
		</div>
		<div class="col-md-12" style="text-align: center; margin-top: 20px;">
			{{Form::open(['url'=>'/purchase_transaction','method'=>'get'])}}
			<i style="color: red; font-size: 15px;" class="fa fa-caret-left"></i>&nbsp;
			{{Form::submit('Back',['class'=>'btn btn-danger'])}}
			{{Form::close()}}
			
		</div>
	</div>
	
</div>


@endsection
