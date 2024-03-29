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

<div style="font-weight: bold; font-size: 25px; color: #B6B0AF;"> VAT LIST </div>

<div style="text-align: right; margin-bottom: 10px;">
	<button type="button" class="btn btn-success waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal"> Add + </button>
</div>


 <table id="vat_table" class="table table-bordered" style="width:100%;">
        <thead style="background: #6686FC;">
            <tr>
            	<th>Sl</th>
            	<th>Product</th>
                <th>Purchase Vat (%)</th>
                <th>Sale Vat (%)</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        	@foreach($vat_data as $key=> $vat_data)
        	<tr>
        		<td>{{$key+1}}</td>
        		<td>{{$vat_data->product_name}}</td>
        		<td>{{$vat_data->purchase_vat}}<span style="font-weight: bold; margin-left: 3px;">%</span></td>
        		<td>{{$vat_data->sale_vat}}<span style="font-weight: bold; margin-left: 3px;">%</span></td>
        		@if($vat_data->vat_status=='0')
        		<td><span class="text-danger" style="font-weight: bold;">{{'Inactive'}}</span></td>
        		@else
        		<td><span class="text-success" style="font-weight: bold;">{{'Active'}}</span></td>
        		@endif
        		<td style="display: inline-flex;">

        			{{Form::open(['url'=>'/vat/'.$vat_data->vat_id.'/edit','method'=>'get'])}}
        			{{Form::submit('Edit',['class'=>'btn btn-info m-r-5'])}}
        			{{Form::close()}}

                    {{Form::open(['url'=>'/vat/'.$vat_data->vat_id,'method'=>'delete'])}}
                    {{Form::submit('Delete',['class'=>'btn btn-warning m-r-5','onclick'=>"return confirm('Are you sure?')"])}}
                    {{Form::close()}}

                    @if($vat_data->vat_status=='0')
                        {{Form::open(['url'=>'/vat/'.$vat_data->vat_id,'method'=>'get'])}}
                        {{Form::submit('Active',['class'=>'btn btn-success m-r-5'])}}
                        {{Form::close()}}
                    @else
                        {{Form::open(['url'=>'/vat/'.$vat_data->vat_id,'method'=>'get'])}}
                        {{Form::submit('Inactive',['class'=>'btn btn-danger m-r-5'])}}
                        {{Form::close()}}
                    @endif

        		</td>
        	</tr>
        	@endforeach
        </tbody>
 
    </table>

 <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel"> Add Vat  </h4>
                        </div>
                        <div class="modal-body">

                        <div class="body">


			                 {{Form::open(['url'=>'/vat','method'=>'post'])}}

			                 {{Form::label('Product')}}
			                   	<div class="form-group">
                                    <div class="form-line">
                          				<select name="product_id" class="form-control">
                          					<option disabled selected value> -- select Product -- </option>
                          					@foreach($product_data as $product_data)
                          					<option value="{{$product_data->product_id}}">{{$product_data->product_name}}</option>
                          					@endforeach
                          				</select>
									</div>
                                </div>

			                 {{Form::label('Purchase Vat (%)')}}
			                   	<div class="form-group">
                                    <div class="form-line">
                          				{{Form::text('purchase_vat','',['class'=>'form-control'])}}
									</div>
                                </div>

                            {{Form::label('Sale Vat (%)')}}
			                   	<div class="form-group">
                                    <div class="form-line">
                          				{{Form::text('sale_vat','',['class'=>'form-control'])}}
									</div>
                                </div>

                            {{Form::label('Status')}}
                                <div class="form-group">
                                    <div class="form-line">
                                    	{{Form::select("vat_status",['1' => 'Active', '0' => 'Inactive'], null,["class" => "form-control"])}}
                                    </div>
                                </div>

                             <div style="text-align: right;">

                             	{{Form::submit('Save',['class'=>'btn btn-success waves-effect'])}}
                             	{{Form::button('Close',['class'=>'btn btn-danger waves-effect','data-dismiss'=>'modal'])}}

                             </div>
							
							{{Form::close()}}

                        </div>
                        </div>
                        <div class="modal-footer">
                            
                        </div>
                    </div>
                </div>
            </div>

<script type="text/javascript">
$(document).ready(function(){
	$('#vat_table').DataTable();
});
	
</script>

@endsection