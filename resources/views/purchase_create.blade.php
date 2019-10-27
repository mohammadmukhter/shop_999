@extends('backend.backend')
@section('main_section')


@include('backend.layouts.toastr')
{!! Toastr::message() !!}

@if($errors->any())
<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<ul>
		@foreach($errors->all() as $errors)
		<li>{{$errors}}</li>
		@endforeach		
	</ul>
</div>
@endif
{{Form::open(['url'=>'/purchase_list','method'=>'post'])}}
<div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div style="background: #FB837D;">
                <div class="body">
                    <ol class="breadcrumb" style="font-weight: bold;">
                        <li><a href="javascript:void(0);">Home</a></li>
                        <li><a href="javascript:void(0);">Library</a></li>
                        <li><a href="javascript:void(0);">Data</a></li>
                        <li class="active">File</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


<div class="panel" style="margin-bottom: 100px;">
	<div class="panel-body">
		<h3 class="title-hero"> Create New Purchase </h3>


		<div style="margin-top: 20px;">
			<div class="col-md-3" style="text-align: right; font-size: 20px;">
				<label  class="control-label"> Supplier Name:</label>
				
			</div>
			<div class="col-md-3">
				<select name="supplier_id" class="form-control">
							<option disabled selected value>--Select Supplier--</option>
						@foreach($supplier_data as $supplier_data)
							<option value="{{$supplier_data->supplier_id}}">{{$supplier_data->supplier_name}}</option>
						@endforeach
				</select>
			</div>
			<div class="col-md-3" style="text-align: right; font-size: 20px;">
				<label  class="control-label"> Voucher Code:</label>
				
			</div>
			<div class="col-md-3" style="text-align: right; font-weight: bold;">
				<input type="text" readonly name="purchase_voucher_code" class="form-control purchase_voucher_code" value="{{$purchase_voucher_code}}">
			</div>
		</div>
	</div>

		<div>
			<table class="table table-bordered bg-info">
				<thead class="bg-black">
					<tr>
						<td class="text-center font-white" style="width: 145px;">Product</td>
						<td class="text-center font-white" style="width: 11.8%;">Unit Cost </td>
						<td class="text-center font-white" style="width: 11.8%;">Quantity</td>
						<td class="text-center font-white" style="width: 145px;">Production Date</td>
						<td class="text-center font-white" style="width: 145px;">Expired Date</td>
						<td class="text-center font-white" style="width: 50px;"> Vat (%)</td>
						<td class="text-center font-white" style="width: 50px;"> Discount (%)</td>
						<td class="text-center font-white" style="width: 11.8%;"> Sub Total </td>
						<td class="text-center font-white" style="width: 5%;"> </td>
					</tr>
				</thead>
					
				<tbody class="input_fields_wrap">
					<tr>
						<td>
							<select style="width: 145px;" name="product_id[]" class="form-control product_button">
								<option disabled selected value>--Select Product--</option>
								@foreach($product_data as $product_data_value)
								<option value="{{$product_data_value->product_id}}">{{$product_data_value->product_name}}</option>
								@endforeach
							</select>
							<input hidden type="text" name="product_code[]" class="product_code">
						</td>
						<td>
							<input type="text" readonly="readonly" name="purchase_unit_price[]" class="form-control text-center purchase_unit_price">
						</td>
						<td>
							<input type="number" min="0" name="purchase_quantity[]" class="form-control text-center purchase_quantity">
						</td>
						<td>
							<input type="date" style="width: 145px;" name="production_date[]" class="form-control text-center">
						</td>
						<td>
							<input type="date" style="width: 145px;" name="expired_date[]" class="form-control text-center">
						</td>
						<td>
							<input type="text" readonly style="width: 50px;" name="purchase_vat[]" class="form-control text-center purchase_vat">
							<input hidden type="text" name="vat_hidden[]" class="vat_hidden">
						</td>
						<td>
							<input type="text" readonly style="width: 50px;" name="purchase_discount[]" class="form-control text-center purchase_discount">
							<input hidden type="text" name="discount_hidden[]" class="discount_hidden">
						</td>
						<td>
							<input type="text" readonly name="purchase_sub_total[]" class="form-control text-center purchase_sub_total">
						</td>
						<td>
							<button type="button" class="btn btn-success add_field_button">
								<i class="fa fa-plus"></i>
							</button>
						</td>
					</tr>
				</tbody>

				<tfoot>
					<tr>
						<td colspan="6" style="text-align: right; font-weight: bold; font-size: 20px;"> Total <span style="font-size: 14px;">(Excluding vat and discount)</span>
						</td>
						<td colspan="3">
							<input type="text" readonly name="purchase_total_price" class="form-control text-center purchase_total_price">
						</td>
					</tr>
					<tr>
						<td colspan="6" style="text-align: right; font-weight: bold; font-size: 20px">
							Total Discount (TK)
						</td>
						<td colspan="3">
							<input type="text" readonly name="total_purchase_discount" class="form-control text-center total_purchase_discount">
						</td>
					</tr>
					<tr>
						<td colspan="6" style="text-align: right; font-weight: bold; font-size: 20px">
							Total Vat(TK)
						</td>
						<td colspan="3">
							<input type="text" readonly name="total_purchase_vat" class="form-control text-center total_purchase_vat">
						</td>
					</tr>
					<tr>
						<td colspan="6" style="text-align: right; font-weight: bold; font-size: 20px">
							Net Total
						</td>
						<td colspan="3">
							<input type="text" readonly name="purchase_net_price" class="form-control text-center purchase_net_price">
						</td>
					</tr>
					<tr>
						<td colspan="6" style="text-align: right; font-weight: bold; font-size: 20px">
							Payment Method
						</td>
						<td colspan="3">
							<select name="purchase_payment_method" class="form-control">
								<option value="0"> Cash </option>
								<option value="1"> Bank </option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="6" style="text-align: right; font-weight: bold; font-size: 20px">
							Paid
						</td>
						<td colspan="3">
							<input type="text" name="purchase_paid" class="form-control text-center purchase_paid">
						</td>
					</tr>
					<tr class="due_tr">
						<td colspan="6" style="text-align: right; font-weight: bold; font-size: 20px">
							Due
						</td>
						<td colspan="3">
							<input type="text" readonly name="purchase_due" class="form-control text-center purchase_due">
						</td>
					</tr>

					<tr class="change_tr">
						<td colspan="6" style="text-align: right; font-weight: bold; font-size: 20px">
							Change
						</td>
						<td colspan="3">
							<input type="text" readonly name="purchase_change" class="form-control text-center purchase_change">
						</td>
					</tr>

					<tr>
						<td colspan="9">
							{{Form::open(['url'=>'#'])}}
							{{Form::submit('SUBMIT',['class'=>'btn btn-success pull-right'])}}
							{{Form::close()}}
						</td>
					</tr>
				</tfoot>
			</table>
		</div>


	</div>

<script type="text/javascript">
	
$(document).ready(function() {

	$('.due_tr').hide();
	$('.change_tr').hide();

    var max_fields      = 10; 
    var wrapper         = $(".input_fields_wrap"); 
    var add_button      = $(".add_field_button");
    var x = 1; 
    $(add_button).click(function(e){ 
        e.preventDefault();
        if(x < max_fields){ 
            x++; 
            $(wrapper).append('<tr>\
					<td>\
							<select style="width: 145px;" name="product_id[]" class="form-control product_button">\
								<option disabled selected value>--Select Product--</option>\
								@foreach($product_data as $product_data_value)\
									<option value="{{$product_data_value->product_id}}">{{$product_data_value->product_name}}</option>\
								@endforeach\
                            </select>\
                            <input hidden type="text" name="product_code[]" class="product_code">\
						</td>\
						<td>\
							<input type="text" readonly name="purchase_unit_price[]" class="form-control text-center purchase_unit_price">\
						</td>\
						<td>\
							<input type="number" min=0 name="purchase_quantity[]" class="form-control text-center purchase_quantity">\
						</td>\
						<td>\
							<input type="date" style="width: 145px;" name="production_date[]" class="form-control text-center">\
						</td>\
						<td>\
							<input type="date" style="width: 145px;" name="expired_date[]" class="form-control text-center">\
						</td>\
						<td>\
							<input type="text" readonly style="width: 50px;" name="purchase_vat[]" class="form-control text-center purchase_vat">\
							<input hidden type="text" name="vat_hidden[]" class="vat_hidden">\
						</td>\
						<td>\
							<input type="text" readonly style="width: 50px;" name="purchase_discount[]" class="form-control text-center purchase_discount">\
							<input hidden type="text" name="discount_hidden[]" class="discount_hidden">\
						</td>\
						<td>\
							<input type="text" readonly name="purchase_sub_total[]" class="form-control text-center purchase_sub_total">\
						</td>\
						<td>\
							<button type="button" class="btn btn-danger remove_field">\
								<i class="fa fa-minus"></i>\
							</button>\
						</td>\
					</tr>');
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ 
        e.preventDefault(); $(this).closest('tr').remove(); x--;


        	var sum = 0;        
			$(".purchase_sub_total").each(function() 
			{ 
			  if(!isNaN(this.value) && this.value.length!=0) 
			  {
			    sum += parseInt(this.value);            
			  }
			   
			});
			$('.purchase_total_price').val(sum);


			var sum_v = 0;        
			$(".vat_hidden").each(function() 
			{ 
			  if(!isNaN(this.value) && this.value.length!=0) 
			  {
			    sum_v += parseFloat(this.value);       
			  }  
			});
			$('.total_purchase_vat').val(sum_v);


			var sum_d = 0; 
			$(".discount_hidden").each(function() 
			{ 
			  if(!isNaN(this.value) && this.value.length!=0) 
			  {
			    sum_d += parseFloat(this.value);       
			  }  
			});
			$('.total_purchase_discount').val(sum_d);


			var t_price= parseFloat($('.purchase_total_price').val());		
			var t_vat= parseFloat($('.total_purchase_vat').val()); 
			var t_discount= parseFloat($('.total_purchase_discount').val());
			var net_price= t_price-t_discount+t_vat;
			
			$('.purchase_net_price').val(net_price);


					var pur_net= parseFloat($('.purchase_net_price').val());
					var pur_paid= parseFloat($('.purchase_paid').val());
					var pur_due= pur_net - pur_paid;
					
					if(pur_due>0)
					{
						$('.purchase_due').val(pur_due);
						$('.purchase_change').val(0);
					}
					else
					{
						$('.purchase_change').val(Math.abs(pur_due));
						$('.purchase_due').val(0);

					}
					

					if(!pur_paid || pur_paid=='0')
					{
						$('.due_tr').hide();
					}
					else
					{
						$('.due_tr').show();
					}

					if(!pur_paid || pur_paid=='0')
					{
						$('.change_tr').hide();
					}
					else
					{
						$('.change_tr').show();
					}
			
    })



		$(document).on('keypress','.purchase_unit_price',function(e){

	       if(e.which != 8 && isNaN(String.fromCharCode(e.which))){
	           e.preventDefault();
	           Swal.fire({
				  type: 'error',
				  title: 'Oops...',
				  text: 'Please Enter Numeric Value!',
				  footer: ''
				})
	       }

	   	});


	   	$(document).on('keypress','.purchase_quantity',function(e){

	       if(e.which != 8 && isNaN(String.fromCharCode(e.which))){
	           e.preventDefault();
	           Swal.fire({
				  type: 'error',
				  title: 'Oops...',
				  text: 'Please Enter Numeric Value!',
				  footer: ''
				})
	       }

	   	});

	   	$(document).on('keypress','.purchase_paid',function(e){

	       if(e.which != 8 && isNaN(String.fromCharCode(e.which))){
	           e.preventDefault();
	           Swal.fire({
				  type: 'error',
				  title: 'Oops...',
				  text: 'Please Enter Numeric Value!',
				  footer: ''
				})
	       }

	   	});


	$(document).on('change','.product_button',function(){
		var data_id=$(this).closest("tr").find(".product_button").val();
		var first=$(this).closest('tr');
				
		$.ajax({
			url:'purchase_ajax_data',
			type:'post',
			data:{
				'_token':'{{ csrf_token() }}',
				'data_id':data_id,
			},
			success:function(data)
			{
				//console.log(data);
				first.find('.product_code').val(data.product_array.product_code);
				first.find(".purchase_unit_price").val(data.product_array.purchase_price);
				first.find('.purchase_quantity').val('1');


				if(!data.vat_array==0)
					{
						first.find(".purchase_vat").val(data.vat_array.purchase_vat);
						
					}
				else
					{
						first.find(".purchase_vat").val(0);
					}

				if(!data.discount_array==0)
					{
						first.find(".purchase_discount").val(data.discount_array.purchase_discount);
						
					}
				else
					{
						first.find(".purchase_discount").val(0);
					}


				var pur_price=first.find('.purchase_unit_price').val();
				var pur_quantity=first.find('.purchase_quantity').val();
				var sub_total=pur_price*pur_quantity;
				first.find('.purchase_sub_total').val(sub_total);


				var pur_vat=first.find('.purchase_vat').val();
				var pur_vat_cal=(sub_total*pur_vat/100);
				first.find('.vat_hidden').val(pur_vat_cal);
					var sum_v = 0; 
					$(".vat_hidden").each(function() 
					{ 

					  if(!isNaN(this.value) && this.value.length!=0) 
					  {
					    sum_v += parseFloat(this.value);       
					  }  
					});
					$('.total_purchase_vat').val(sum_v);


				var pur_discount=first.find('.purchase_discount').val();
				var pur_discount_cal=(sub_total*pur_discount/100);
				first.find('.discount_hidden').val(pur_discount_cal);
					var sum_d = 0; 
					$(".discount_hidden").each(function() 
					{ 

					  if(!isNaN(this.value) && this.value.length!=0) 
					  {
					    sum_d += parseFloat(this.value);       
					  }  
					});
					$('.total_purchase_discount').val(sum_d);


				var sum = 0;        
				$(".purchase_sub_total").each(function() 
				{ 
				  if(!isNaN(this.value) && this.value.length!=0) 
				  {
				    sum += parseInt(this.value);            
				  }
				   
				});
				$('.purchase_total_price').val(sum); 

				var t_price= parseFloat($('.purchase_total_price').val());		
				var t_vat= parseFloat($('.total_purchase_vat').val()); 
				var t_discount= parseFloat($('.total_purchase_discount').val());
				var net_price= t_price-t_discount+t_vat;
				console.log(net_price);
				$('.purchase_net_price').val(net_price);




					var pur_net= parseFloat($('.purchase_net_price').val());
					var pur_paid= parseFloat($('.purchase_paid').val());
					var pur_due= pur_net - pur_paid;

					
					if(pur_due>0)
					{
						$('.purchase_due').val(pur_due);
						$('.purchase_change').val(0);
					}
					else
					{
						$('.purchase_change').val(Math.abs(pur_due));
						$('.purchase_due').val(0);

					}

					

					if(!pur_paid || pur_paid=='0')
					{
						$('.due_tr').hide();
					}
					else
					{
						$('.due_tr').show();
					}

					if(!pur_paid || pur_paid=='0')
					{
						$('.change_tr').hide();
					}
					else
					{
						$('.change_tr').show();
					}


			}
		});

	});

	$(document).on('change','.purchase_quantity',function(){

		var pur_price=$(this).closest('tr').find('.purchase_unit_price').val();
		var pur_quantity=$(this).closest('tr').find('.purchase_quantity').val();
		var sub_total=pur_price*pur_quantity;
		$(this).closest('tr').find('.purchase_sub_total').val(sub_total);


			var sum = 0;        
			$(".purchase_sub_total").each(function() 
			{ 
			  if(!isNaN(this.value) && this.value.length!=0) 
			  {
			    sum += parseInt(this.value);            
			  }
			   
			});
			$('.purchase_total_price').val(sum);


			var pur_vat=$(this).closest('tr').find('.purchase_vat').val();
			var pur_vat_cal=(sub_total*pur_vat/100);
			$(this).closest('tr').find('.vat_hidden').val(pur_vat_cal);
			var sum_v = 0;        
			$(".vat_hidden").each(function() 
			{ 
			  if(!isNaN(this.value) && this.value.length!=0) 
			  {
			    sum_v += parseFloat(this.value);       
			  }  
			});
			$('.total_purchase_vat').val(sum_v);


			var pur_discount=$(this).closest('tr').find('.purchase_discount').val();
			var pur_discount_cal=(sub_total*pur_discount/100);
			$(this).closest('tr').find('.discount_hidden').val(pur_discount_cal);
			var sum_d = 0; 
			$(".discount_hidden").each(function() 
			{ 
			  if(!isNaN(this.value) && this.value.length!=0) 
			  {
			    sum_d += parseFloat(this.value);       
			  }  
			});
			$('.total_purchase_discount').val(sum_d);



			var t_price= parseFloat($('.purchase_total_price').val());		
			var t_vat= parseFloat($('.total_purchase_vat').val()); 
			var t_discount= parseFloat($('.total_purchase_discount').val());
			var net_price= t_price-t_discount+t_vat;
			$('.purchase_net_price').val(net_price);
			$('.purchase_due').val(net_price);


					var pur_net= parseFloat($('.purchase_net_price').val());
					var pur_paid= parseFloat($('.purchase_paid').val());
					var pur_due= pur_net - pur_paid;
					
					if(pur_due>0)
					{
						$('.purchase_due').val(pur_due);
						$('.purchase_change').val(0);
					}
					else
					{
						$('.purchase_change').val(Math.abs(pur_due));
						$('.purchase_due').val(0);

					}
					

					if(!pur_paid || pur_paid=='0')
					{
						$('.due_tr').hide();
					}
					else
					{
						$('.due_tr').show();
					}

					if(!pur_paid || pur_paid=='0')
					{
						$('.change_tr').hide();
					}
					else
					{
						$('.change_tr').show();
					}

	});

	$(document).on('keyup','.purchase_paid',function(){
		var pur_net= parseFloat($('.purchase_net_price').val());
		var pur_paid= parseFloat($('.purchase_paid').val());
		var pur_due= pur_net - pur_paid;
		
		if(pur_due>0)
		{
			$('.purchase_due').val(pur_due);
			$('.purchase_change').val(0);
		}
		else
		{
			$('.purchase_change').val(Math.abs(pur_due));
			$('.purchase_due').val(0);

		}
		

		if(!pur_paid || pur_paid=='0')
		{
			$('.due_tr').hide();
		}
		else
		{
			$('.due_tr').show();
		}

		if(!pur_paid || pur_paid=='0')
		{
			$('.change_tr').hide();
		}
		else
		{
			$('.change_tr').show();
		}
		
		

	});

});

</script>
{{Form::close()}}
@endsection