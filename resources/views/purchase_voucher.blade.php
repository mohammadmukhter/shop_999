 <link href="{{asset('backend_asset/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<div class="container">
<div class="panel">
	<div style="text-align: right;" >
		<button id="print_button" onclick="printDiv('P_area')">Print</button>
	</div>

	<div class="panel-body" id="P_area">
		<span style="float: right; font-weight: bold; font-size: 30px;">
			@if($purchase_transaction_data->purchase_transaction_status==0)
			<span style="background: #F35750; padding:5px 10px;">DUE</span>
			@else
			<span style="background: #38AF48; padding:5px 10px;">PAID</span>
			@endif
			
		</span>
		<div style="text-align: left; color: black; font-size: 30px; font-weight: bold; margin-left: 20px;"> Shop -999
		</div>
		
		<div style="margin-left: 20px;">
			Mirpur-10, Dhaka
			<br>
			Email: shopowner@email.com
			<span style="float: right;"><span style="color: black; font-weight: bold;">Voucher Code :</span> <span style="color: red; ">{{$voucher_code}}</span></span>
		</div>
		
		<hr>

		<div class="col-md-6 col-sm-12">
			<span style="color: black; font-weight: bold;">Shipping From :</span> {{'Supply Company'}}
		</div>
		<div class="col-md-6 col-sm-12" style="text-align: right;">
			<span style="color: black; font-weight: bold;">Shipping To :</span> {{'Shop Owner'}}
		</div>

		

		<div style="margin-top: 150px;">
			<table class="table table-bordered">
				<thead>
					<tr style="font-weight: bold;">
						<td>Supplier Name</td>
						<td>Company Name</td>
						<td>Purchase Date</td>							
					</tr>
				</thead>
				<tbody>
					
					<tr>
						<td>{{$purchase_transaction_data->supplier_name}}</td>
						<td>{{$purchase_transaction_data->company_name}}</td>
						<td>{{$purchase_transaction_data->created_at->format('m/d/Y')}}</td>
					</tr>
				
				</tbody>
			</table>
		</div>


		<div>
			<table class="table table-bordered">
				<thead>
					<tr style="font-weight: bold;">
						<td>Sl</td>
						<td>Product</td>
						<td>Unit Cost</td>
						<td>Quantity</td>
						<td>Vat (%)</td>
						<td>Discount (%)</td>
						<td>Sub Total</td>
					</tr>
				</thead>
				<tbody>
					@foreach($purchase_data as $key=> $p_data)
					<tr>
						<td>{{$key+1}}</td>
						<td>{{$p_data->product_name}}</td>
						<td>{{$p_data->purchase_unit_price}}</td>
						<td>{{$p_data->purchase_quantity}}</td>
						<td>{{$p_data->purchase_vat}}</td>
						<td>{{$p_data->purchase_discount}}</td>
						<td>{{$p_data->purchase_sub_total}}</td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td colspan="6" style="text-align: right; font-weight: bold;"> Total <span style="font-size: 14px;">(Excluding vat and discount)</span></td>
						<td colspan="1"> {{$purchase_transaction_data->purchase_total_price}} </td>
					</tr>
					<tr>
						<td colspan="6" style="text-align: right; font-weight: bold;"> Total Discount (TK) </td>
						<td colspan="1">{{$purchase_transaction_data->total_purchase_discount}}</td>
					</tr>
					<tr>
						<td colspan="6" style="text-align: right; font-weight: bold;"> Total Vat(TK) </td>
						<td colspan="1">{{$purchase_transaction_data->total_purchase_vat}}</td>
					</tr>
					<tr>
						<td colspan="6" style="text-align: right; font-weight: bold;"> Net Total </td>
						<td colspan="1">{{$purchase_transaction_data->purchase_net_price}}</td>
					</tr>
					<tr>
						<td colspan="6" style="text-align: right; font-weight: bold;"> Payment Method </td>
						<td colspan="1">
							@if($purchase_transaction_data->payment_method==0)
							{{'CASH'}}
							@else
							{{'BANK'}}
							@endif
						</td>
					</tr>
					<tr>
						<td colspan="6" style="text-align: right; font-weight: bold;"> Paid </td>
						<td colspan="1"> {{$purchase_transaction_data->purchase_paid}} </td>

					</tr>
					<tr>
						<td colspan="6" style="text-align: right; font-weight: bold;"> Due </td>
						<td colspan="1"> {{$purchase_transaction_data->purchase_due}} </td>
					</tr>
					<tr>
						<td colspan="6" style="text-align: right; font-weight: bold;"> Change </td>
						<td colspan="1">{{$purchase_transaction_data->purchase_change}} </td>
					</tr>

				</tfoot>
			</table>

			<div>
				<hr>
				***Vat***<br>
					@foreach($purchase_data as $key=> $v_data)
						@if($v_data->purchase_vat!=0)
						<span>{{$key+1}}.{{$v_data->product_name}}={{$v_data->purchase_vat_amount}} taka</span><br>
						@endif
					@endforeach

					@if($purchase_transaction_data->total_purchase_vat==0)
						<span style="color: #8D8D8D;">{{"No Vat"}}</span><br>
					@endif
						
						
				<br>
				***Discount***<br>				
					@foreach($purchase_data as $key=> $d_data)
						@if($d_data->purchase_discount!=0)
						<span >{{$key+1}}.{{$d_data->product_name}}={{$d_data->purchase_discount_amount}} taka</span><br>
						@endif
					@endforeach	

					@if($purchase_transaction_data->total_purchase_discount==0)
						<span style="color: #8D8D8D;">{{"No Discount"}}</span><br>
					@endif

				<hr>
			</div>

			<div style="text-align: center;">
				any comments
				<hr>
			</div>
			
		</div>
	</div>
		
</div>
</div>

<script type="text/javascript">

	function printDiv(divId) {
	     var printContents = document.getElementById(divId).innerHTML;
	     var originalContents = document.body.innerHTML;
	     document.body.innerHTML = printContents;
	     window.print();
	     document.body.innerHTML = originalContents;
	}

</script>