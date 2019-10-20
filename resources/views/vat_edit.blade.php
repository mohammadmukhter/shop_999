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

						{{Form::open(['url'=>'/vat/'.$edit_data->vat_id,'method'=>'put'])}}      
              <div class="col-md-6">
                {{Form::label('Product')}}
        				<select name="product_id" class="form-control">
        					<option value="{{$edit_data->product_id}}">{{$edit_data->product_name}}</option>
                  
        				</select>
              </div>
                           

			                 
			                   
                  <div class="col-md-6">
                  	{{Form::label('Purchase Vat (%)')}}
        				    {{Form::text('purchase_vat',$edit_data->purchase_vat,['class'=>'form-control'])}}
									</div> 
                              

                            
               		<div class="col-md-6">
                    {{Form::label('Sale Vat (%)')}}
                		{{Form::text('sale_vat',$edit_data->sale_vat,['class'=>'form-control'])}}
									</div>
                                
                            
                               
                  <div class="col-md-6">
                    {{Form::label('Status')}}
                  	<select class="form-control" name="vat_status">
                        @if($edit_data->vat_status=='0')
                        <option value='0'>Inactive</option>
                        <option value='1'>Active</option>
                        @else
                        <option value='1'>Active</option>
                        <option value='0'>Inactive</option>
                        @endif
                    </select>
                  </div>
                                

                 <div class="col-md-12" style="text-align: center; margin-top: 30px;">
                 	{{Form::submit('Save',['class'=>'btn btn-success waves-effect','style'=>'padding:5px 30px;'])}}
                 </div>
							
						{{Form::close()}}

@endsection