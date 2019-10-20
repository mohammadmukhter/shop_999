@extends('backend.backend')
@section('main_section')

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
{{Form::open(['url'=>'#'])}}

		<div style="margin-top: 20px; margin-left: 25%;">
			<div class="col-md-3" style="text-align: right; font-size: 20px;">
				<label  class="control-label"> Supplier Name:</label>
				
			</div>
			<div class="col-md-3">
				<select class="form-control">
					<option>name1</option>
					<option>name2</option>
					<option>name3</option>
				</select>
			</div>
		</div>
	</div>

		<div>
			<table class="table table-bordered bg-info">
				<thead class="bg-black">
					<tr>
						<td class="text-center font-white" style="width: 19%;">Product</td>
						<td class="text-center font-white" style="width: 19%;">Unit Cost </td>
						<td class="text-center font-white" style="width: 19%;">Quantity</td>
						<td class="text-center font-white" style="width: 19%;">Product Vat</td>
						<td class="text-center font-white" style="width: 19%;"> Sub Total </td>
						<td class="text-center font-white" style="width: 5%;"> </td>
					</tr>
				</thead>
					
				<tbody class="input_fields_wrap">
					<tr>
						<td>
							<select class="form-control">
								<option> Apple </option>
							</select>
						</td>
						<td>
							<input type="text" name="purchase_unit_price" class="form-control text-center purchase_unit_price">
						</td>
						<td>
							<input type="text" name="purchase_quantity" class="form-control text-center">
						</td>
						<td>
							<input type="text" name="purchase_vat" class="form-control text-center">
						</td>
						<td>
							<input type="text" name="purchase_sub_total" class="form-control text-center">
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
						<td colspan="4" style="text-align: right; font-weight: bold; font-size: 20px;"> Total <span style="font-size: 14px;">(Excluding vat)</span>
						</td>
						<td colspan="2">
							<input type="text" name="purchase_total_price" class="form-control text-center">
						</td>
					</tr>
					<tr>
						<td colspan="4" style="text-align: right; font-weight: bold; font-size: 20px">
							Discount
						</td>
						<td colspan="2">
							<input type="text" name="purchase_discount" class="form-control text-center">
						</td>
					</tr>
					<tr>
						<td colspan="4" style="text-align: right; font-weight: bold; font-size: 20px">
							Vat
						</td>
						<td colspan="2">
							<input type="text" name="purchase_vat" class="form-control text-center">
						</td>
					</tr>
					<tr>
						<td colspan="4" style="text-align: right; font-weight: bold; font-size: 20px">
							Net Total
						</td>
						<td colspan="2">
							<input type="text" name="purchase_net_price" class="form-control text-center">
						</td>
					</tr>
					<tr>
						<td colspan="4" style="text-align: right; font-weight: bold; font-size: 20px">
							Payment Method
						</td>
						<td colspan="2">
							<select name="purchase_payment_method" class="form-control">
								<option value="0"> Cash </option>
								<option value="1"> Bank </option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="4" style="text-align: right; font-weight: bold; font-size: 20px">
							Paid
						</td>
						<td colspan="2">
							<input type="text" name="purchase_paid" class="form-control text-center">
						</td>
					</tr>
					<tr>
						<td colspan="4" style="text-align: right; font-weight: bold; font-size: 20px">
							Due
						</td>
						<td colspan="2">
							<input type="text" name="purchase_due" class="form-control text-center">
						</td>
					</tr>
					<tr>
						<td colspan="6">
							{{Form::open(['url'=>'#'])}}
							{{Form::submit('SUBMIT',['class'=>'btn btn-success pull-right'])}}
							{{Form::close()}}
						</td>
					</tr>
				</tfoot>
			</table>
		</div>

{{Form::close()}}
	</div>

<script type="text/javascript">
	
$(document).ready(function() {
    var max_fields      = 10; 
    var wrapper         = $(".input_fields_wrap"); 
    var add_button      = $(".add_field_button");

    var x = 1; 
    $(add_button).click(function(e){ 
        e.preventDefault();
        if(x < max_fields){ 
            x++; 
            $(wrapper).append(`<tr>
						<td>
							<select class="form-control">
								<option> Apple </option>
							</select>
						</td>
						<td>
							<input type="text" name="purchase_unit_price" class="form-control text-center">
						</td>
						<td>
							<input type="text" name="purchase_quantity" class="form-control text-center">
						</td>
						<td>
							<input type="text" name="purchase_vat" class="form-control text-center">
						</td>
						<td>
							<input type="text" name="purchase_sub_total" class="form-control text-center">
						</td>
						<td>
							<button type="button" class="btn btn-danger remove_field">
								<i class="fa fa-minus"></i>
							</button>
						</td>
					</tr>`);
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ 
        e.preventDefault(); $(this).closest('tr').remove(); x--;
    })



		$('.purchase_unit_price').keypress(function(e){

	       if(e.which != 8 && isNaN(String.fromCharCode(e.which))){
	           e.preventDefault();
	           Swal.fire({
				  type: 'error',
				  title: 'Oops...',
				  text: 'Please Enter Numeric Value!',
				  footer: ''
				})
	       }

		   //      var value = $(this).val();
	    // 		if ( value.length >= 12) 
	    // 		{
	    // 			Swal.fire({
					//   type: 'error',
					//   title: 'Oops...',
					//   text: 'Not more than 8 digit!',
					//   footer: ''
					// })
	    // 		}


	   	});
		
});

</script>

@endsection