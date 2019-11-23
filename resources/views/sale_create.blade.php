@extends('backend.backend')
@section('main_section')

@include('backend.layouts.toastr')
{!! Toastr::message() !!}

@if($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach($errors->all() as $errors)
		<li>{{$errors}}</li>
		@endforeach		
	</ul>
</div>
@endif

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


{{Form::open(['url'=>'/sale_list','method'=>'post'])}}
<div class="panel">
	<div class="panel-head" style="padding-left: 15px;">
		<h1><span style="color:red;"><i class="fa fa-cart-arrow-down"></i> P</span><span style="color: green;">O</span><span style="color:blue;">S</span></h1>
	</div>
	<div class="panel-body">
			<div class="col-md-6" style="border: 2px solid rgb(221, 221, 221);">
				<div class="row" style="background: black;">
					{{Form::open(['url'=>'/sale_create','method'=>'get'])}}
					<div class="col-md-10">
						<input class="form-control" placeholder="Search Product" type="text" name="product_search" value="{{Request::get('product_search')}}" style="width: 100%; border: 3px solid #000;">
					</div>
					<div class="col-md-2" style="margin-top: 3.5px;">
						<button class="btn-info" style="padding: 0px 20px;"><i class="fa fa-search"></i></button>
					</div>
					<input type="hidden" name="filter" value="filter">
					{{Form::close()}}
				</div>

				<div class="row" style="padding:25px 0px;">	
					<div style="min-height: 600px;">
						<div class="col-md-12" style="margin:0px 25px;">

						@foreach($product_data as $p_data)
							@php
								$stock=collect($stock_data)
								->where('product_id',$p_data->product_id)
								->whereIn('stock_status',['1','2'])
								->count();
							@endphp

							<div class="col-md-3" style="min-height: 200px; max-height: 200px; margin: 10px 10px; background: rgb(255,255,255); border: 1px solid #eee;">
								<center>
									<img src="{{asset('image_upload/'.$p_data->image)}}" class="img-rounded" style="height: 100px; width: 108px; margin-left: -15px;">

									@if($stock>0)

									<button class="btn btn-primary product_button" style="margin-top:-195px; margin-left: 65px; padding: 3px 3px;"><i style="padding-right:3px; padding-bottom:2px;" class="fa fa-cart-arrow-down"></i></button>
									@else
									<button disabled class="btn btn-danger" style="margin-top:-195px; margin-left: 65px; padding: 3px 3px;"><i style="padding-right:3px; padding-bottom:2px;" class="fa fa-cart-arrow-down"></i></button>
									@endif
										<input hidden=""  class="p_id" type="text" name="p_id" value="{{$p_data->product_id}}">
									

									<p style="min-height: 20px;">{{$p_data->product_name}}</p>
									<small>
										
										@if($stock > 0)
											<span style="color: green; font-weight: bold;">
												In Stock
											</span>
											({{$stock}})
										@else
											<span style="color: red; font-weight: bold;">
											Out of Stock
											</span>										
										@endif
									</small>
								</center>
							</div>

						@endforeach

						</div>
					</div>	
				</div>
			</div>

			<div class="col-md-6" style="border: 2px solid rgb(221, 221, 221);">
				<div class="row" style="background: black;">
					<div class="col-md-12">
						<select class="form-control" name="customer_id" style="width: 100%; border: 3px solid #000;">
							<option disabled selected value> --Select Customer--</option>

							@foreach($customer_data as $c_data)
							<option value="{{$c_data->customer_id}}">{{$c_data->customer_name}}</option>
							@endforeach

						</select>
					</div>
				</div>

				<div class="row" style="padding:5px 10px;">
					<div style="min-height: 600px;">
						<table class="table">
							<thead> 
								<tr style="background: #68B7B4; font-weight: bold;">
									<td class="td_border" >Product</td>
									<td class="td_border" >Price</td>
									<td class="td_border" >Quantity</td>
									<td class="td_border" >SubTotal</td>
									<td class="td_border" ></td>
								</tr>
							</thead>

							<tbody class="input_fields_wrap">
								
							</tbody>

							<tfoot class="hidden_footer">
								<tr>
									<td colspan="2" class="td_border" style="background: #68B7B4; font-weight: bold;">Total Price</td>
									<td colspan="3" class="td_border" align="center">
										<input class="form-control text-center sale_total_price" type="text" name="sale_total_price" value="" style="width: 100%;">
									</td>
								</tr>

								<tr>
									<td colspan="2" class="td_border" style="background: #68B7B4; font-weight: bold;">Total Discount (Tk)</td>
									<td colspan="3" class="td_border" align="center">
										<input class="form-control text-center total_sale_discount" type="text" name="total_sale_discount" value="" style="width: 100%;">
									</td>
								</tr>

								<tr>
									<td colspan="2" class="td_border" style="background: #68B7B4; font-weight: bold;">Total Vat (Tk)</td>
									<td colspan="3" class="td_border" align="center">
										<input class="form-control text-center total_sale_vat" type="text" name="total_sale_vat" value="" style="width: 100%;">
									</td>
								</tr>

								<tr>
									<td colspan="2" class="td_border" style="background: #68B7B4; font-weight: bold;">Net Price</td>
									<td colspan="3" class="td_border" align="center">
										<input class="form-control text-center sale_net_total" type="text" name="sale_net_total" value="" style="width: 100%;">
									</td>
								</tr>

								<tr>
									<td colspan="2" class="td_border" style="background: #68B7B4; font-weight: bold;">Payment Type</td>
									<td colspan="3" class="td_border" align="center">
										<select class="form-control text-center sale_payment_method" name="sale_payment_method" style="width: 100%;">
											<option value="0">CASH</option>
											<option value="1">BANK</option>
										</select>
									</td>
								</tr>

								<tr>
									<td colspan="2" class="td_border" style="background: #68B7B4; font-weight: bold;">Paid</td>
									<td colspan="3" class="td_border" align="center">
										<input class="form-control text-center sale_paid" type="text" name="sale_paid" value="" style="width: 100%;">
									</td>
								</tr>

								<tr class="s_due_hide">
									<td colspan="2" class="td_border" style="background: #68B7B4; font-weight: bold;">Due</td>
									<td colspan="3" class="td_border" align="center">
										<input class="form-control text-center sale_due" type="text" name="sale_due" value="" style="width: 100%;">
									</td>
								</tr>

								<tr class="s_change_hide">
									<td colspan="2" class="td_border" style="background: #68B7B4; font-weight: bold;">Change</td>
									<td colspan="3" class="td_border" align="center">
										<input class="form-control text-center sale_change" type="text" name="sale_change" value="" style="width: 100%;">
									</td>
								</tr>

								<tr>
									<td colspan="5" style="text-align: center;">
										<button class="btn btn-success">SALE</button>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
				
			</div>
		</div>
</div>

<script type="text/javascript">
	
    $(document).on('keypress','.sale_quantity',function(e){

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

	$(document).on('keypress','.sale_paid',function(e){

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


	$('.hidden_footer').hide();

    var wrapper         = $(".input_fields_wrap"); 
    var add_button      = $(".product_button");


    $(add_button).click(function(e){
    	e.preventDefault();
    	var p_id= $(this).closest('center').find('.p_id').val();
   

   $('.product_id').each(function(){
		if( !isNaN(this.value) && this.value == p_id)
		{
			e.preventDefault();
	           Swal.fire({
				  type: 'error',
				  title: 'Oops...',
				  text: 'Already Selected this Product!',
				  footer: ''
				});
	           exit();
		}
	});

        	$.ajax({
			url:'sale_ajax_data',
			type:'post',
			data:{
				'_token':'{{csrf_token()}}',
				'p_id':p_id,
			},

			success:function(data)
			{

				if(data.vat_array)
				{
					var sale_vat=data.vat_array.sale_vat;
				}
				else
				{
					var sale_vat=0;
				}
				if(data.discount_array)
				{
					var sale_discount=data.discount_array.sale_discount;
				}
				else
				{
					var sale_discount=0;
				}

				var stock_data=data.stock_array;
				


				var sale_price= data.product_array.sale_price;
				var sale_sub_total= sale_price*1;
				var sale_vat_amount=(sale_sub_total*sale_vat/100);

				var sale_discount_amount=(sale_sub_total*sale_discount/100);

				  $(wrapper).append('<tr>\
									<td><input class="form-control product_name" style="width: 100px;" type="text" name="product_name[]" value="'+data.product_array.product_name+'">\
										<input type="hidden" name="product_id[]" class="form-control product_id" value="'+data.product_array.product_id+'">\
										<input type="hidden" name="product_code[]" class="form-control product_code" value="'+data.product_array.product_code+'">\
										<input type="hidden" name="stock_data[]" class="form-control stock_data" value="'+stock_data+'">\
										</td>\
									<td><input class="form-control sale_unit_price" style="width: 70px;" type="text" name="sale_unit_price[]" value="'+data.product_array.sale_price+'">\
										<input class="form-control sale_vat" style="width: 70px;" type="hidden" name="sale_vat[]" value="'+sale_vat+'">\
										<input class="form-control sale_vat_amount" style="width: 70px;" type="hidden" name="sale_vat_amount[]" value="'+sale_vat_amount+'">\
										<input class="form-control sale_discount" style="width: 70px;" type="hidden" name="sale_discount[]" value="'+sale_discount+'">\
										<input class="form-control sale_discount_amount" style="width: 70px;" type="hidden" name="sale_discount_amount[]" value="'+sale_discount_amount+'">\
									</td>\
									<td><input class="form-control sale_quantity" style="width: 100%;" type="number" min="0" name="sale_quantity[]" value='+1+'></td>\
									<td><input class="form-control sale_sub_total" style="width: 100%;" type="text" name="sale_sub_total[]" value='+sale_sub_total+'></td>\
									<td class="td_border">\
										<button type="button" class="btn btn-danger remove_field">\
										<i class="fa fa-minus"></i>\
										</button>\
									</td>\
								</tr>');

				  	  sum_total=0;
					  $('.sale_sub_total').each(function(){
						  	
						  	if(!isNaN(this.value) && this.value.length!=0) 
							{
							    sum_total += parseFloat(this.value);       
							}
							
					  })
					  $('.sale_total_price').val(sum_total);

					  sum_d=0;
					  $('.sale_discount_amount').each(function(){
					  		if(!isNaN(this.value) && this.value.length!=0)
					  		{
					  			sum_d += parseFloat(this.value);
					  		}
					  })
					  $('.total_sale_discount').val(sum_d);

					  sum_v=0;
					  $('.sale_vat_amount').each(function(){
						  	if(!isNaN(this.value) && this.value.length!=0)
						  	{
						  		sum_v += parseFloat(this.value);
						  	}
					  })
					  $('.total_sale_vat').val(sum_v);

					  sum_net_price= (sum_total-sum_d)+sum_v;
					  $('.sale_net_total').val(sum_net_price);

						var paid= parseFloat($('.sale_paid').val());
				    	var net= parseFloat($('.sale_net_total').val());
				    	var due= net-paid;

				    	if( due>0 )
				    	{
				    		$('.sale_due').val(due);
				    		$('.sale_change').val(0);
				    	}
				    	else
				    	{
				    		$('.sale_change').val(Math.abs(due));
				    		$('.sale_due').val(0);
				    	}

			}
		});



    	$('.hidden_footer').show();

    	$('.s_due_hide').hide();
    	$('.s_change_hide').hide();


    
    });


    $(wrapper).on("click",".remove_field", function(e){
        e.preventDefault();

        $(this).closest('tr').remove();

         	 		 sum_total=0;
					  $('.sale_sub_total').each(function(){
						  	
						  	if(!isNaN(this.value) && this.value.length!=0) 
							{
							    sum_total += parseFloat(this.value);       
							}
							
					  })
					  $('.sale_total_price').val(sum_total);
					  

					  sum_d=0;
					  $('.sale_discount_amount').each(function(){
					  		if(!isNaN(this.value) && this.value.length!=0)
					  		{
					  			sum_d += parseFloat(this.value);
					  		}
					  })
					  $('.total_sale_discount').val(sum_d);

					  sum_v=0;
					  $('.sale_vat_amount').each(function(){
						  	if(!isNaN(this.value) && this.value.length!=0)
						  	{
						  		sum_v += parseFloat(this.value);
						  	}
					  })
					  $('.total_sale_vat').val(sum_v);

					  sum_net_price= (sum_total-sum_d)+sum_v;
					  $('.sale_net_total').val(sum_net_price);

						var paid= parseFloat($('.sale_paid').val());
				    	var net= parseFloat($('.sale_net_total').val());
				    	var due= net-paid;

				    	if( due>0)
				    	{
				    		$('.sale_due').val(due);
				    		$('.sale_change').val(0);

				    	}
				    	else
				    	{
				    		$('.sale_change').val(Math.abs(due));
				    		$('.sale_due').val(0);

				    	}


					  	
    });

    
    $(document).on('change','.sale_quantity',function(){
    	var s_quantity= $(this).closest('tr').find('.sale_quantity').val();
    	var s_price= $(this).closest('tr').find('.sale_unit_price').val();
    	var s_vat= $(this).closest('tr').find('.sale_vat').val();
    	var s_discount= $(this).closest('tr').find('.sale_discount').val();

    		var stock_data= $(this).closest('tr').find('.stock_data').val();
    		if(stock_data<this.value)
    		{
    			$(this).attr('max',stock_data);
    		}

    	var sale_sub_total= s_quantity*s_price;
    	var s_vat_amount=(sale_sub_total*s_vat/100);
		var s_discount_amount=(sale_sub_total*s_discount/100);

    	$(this).closest('tr').find('.sale_sub_total').val(sale_sub_total);
    	$(this).closest('tr').find('.sale_vat_amount').val(s_vat_amount);
    	$(this).closest('tr').find('.sale_discount_amount').val(s_discount_amount);

    		  sum_total=0;
			  $('.sale_sub_total').each(function(){
				  	
				  	if(!isNaN(this.value) && this.value.length!=0) 
					{
					    sum_total += parseFloat(this.value);       
					}
					
			  })
			  $('.sale_total_price').val(sum_total);
			 

			  sum_d=0;
			  $('.sale_discount_amount').each(function(){
			  		if(!isNaN(this.value) && this.value.length!=0)
			  		{
			  			sum_d += parseFloat(this.value);
			  		}
			  })
			  $('.total_sale_discount').val(sum_d);

			  sum_v=0;
			  $('.sale_vat_amount').each(function(){
				  	if(!isNaN(this.value) && this.value.length!=0)
				  	{
				  		sum_v += parseFloat(this.value);
				  	}
			  })
			  $('.total_sale_vat').val(sum_v);

			  sum_net_price= (sum_total-sum_d)+sum_v;
			  $('.sale_net_total').val(sum_net_price);

				var paid= parseFloat($('.sale_paid').val());
		    	var net= parseFloat($('.sale_net_total').val());
		    	var due= net-paid;

		    	if( due>0)
		    	{
		    		$('.sale_due').val(due);
		    		$('.sale_change').val(0);
		    	}
		    	else
		    	{
		    		$('.sale_change').val(Math.abs(due));
		    		$('.sale_due').val(0);
		    	}
    	
    });

    $(document).on('keyup','.sale_paid',function(){
    	var paid= parseFloat($(this).val());
    	var net= parseFloat($('.sale_net_total').val());
    	var due= net-paid;


    	if( due>0)
    	{
    		$('.sale_due').val(due);
    		$('.sale_change').val(0);
    	}
    	else
    	{
    		$('.sale_change').val(Math.abs(due));
    		$('.sale_due').val(0);
    		
    	}

	    	if(paid)
	    	{
	    		$('.s_due_hide').show();
	    		$('.s_change_hide').show();
	    	}
	    	else
	    	{
	    		$('.s_due_hide').hide();
	    		$('.s_change_hide').hide();
	    	}


    	
    })

</script>
{{Form::close()}}

@endsection