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


<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 1111col-xs-12">
        <div class="card">
            <div class="header">

                <div style="text-align: right;">
                <button type="button" class="btn btn-success waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal"> Add + </button>
                </div>

                <h2>
                   Sub Category
                </h2> 
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Product Name</th>
                                <th>Product Code</th>
                                <th>Category Name</th>
                                <th>Sub Category Name</th>
                                <th>Unit</th>
                                <th>Sale price</th>
                                <th>Expired date</th>
                                <th> Image </th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                
                        <tbody>
                        @foreach($product_data as $key=> $product_data)          
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$product_data->product_name}}</td>
                            <td>{{$product_data->product_code}}</td>
                            <td>{{$product_data->c_name}}</td>
                            <td>{{$product_data->sub_category_name}}</td>
                            <td>{{$product_data->unit_name}}</td>
                            <td>{{$product_data->sale_price}}</td>
                            <td>{{$product_data->expired_date}}</td>
                            <td><img style="width: 100px; height: 60px;" src="{{ asset('image_upload/'. $product_data->image) }}"></td>

                            @if($product_data->product_status=='0')
                            <td><span style="font-weight: bold;" class="text-danger">{{'Inactive'}}</span></td>
                            @else
                            <td><span style="font-weight: bold;" class="text-success">{{'Active'}}</span></td>
                            @endif

                            <td style="display: inline-flex;">
                                
                                {{Form::open(['url'=>'/product/'.$product_data->product_id,'method'=>'delete'])}}
                                {{Form::submit('Delete',['class'=>'btn btn-warning', 'onclick'=>"return confirm('Are You Sure?')", 'style'=>'margin-right:5px;'])}}
                                {{Form::close()}}

                                {{Form::open(['url'=>'/product/'.$product_data->product_id.'/edit','method'=>'get'])}}
                                {{Form::submit('Edit',['class'=>'btn btn-info' , 'style'=>'margin-right:5px;'])}}
                                {{Form::close()}}

                                @if($product_data->product_status=='0')
                                    {{Form::open(['url'=>'/product/'.$product_data->product_id,'method'=>'get'])}}
                                    {{Form::submit('Active',['class'=>'btn btn-success' , 'style'=>'margin-right:5px;'])}}
                                    {{Form::close()}}
                                @else
                                     {{Form::open(['url'=>'/product/'.$product_data->product_id,'method'=>'get'])}}
                                    {{Form::submit('Inactive',['class'=>'btn btn-danger' , 'style'=>'margin-right:5px;'])}}
                                    {{Form::close()}}
                                @endif


                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>








 <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel"> Add Product  </h4>
                        </div>
                        <div class="modal-body">

                        <div class="body">

			                 {{Form::open(['url'=>'/product','method'=>'post','enctype'=>'multipart/form-data'])}}
			                     {{Form::label('Product Name')}}
			                   	<div class="form-group">
                                    <div class="form-line">
                          				{{Form::text('product_name','',['class'=>'form-control'])}}
									</div>
                                </div>

                                {{Form::label('Category Name')}}
                                <div class="form-group">
                                    <div class="form-line">
                                        
                                        <select class="form-control category" name="category_id">
                                           <option disabled selected value> -- select Category -- </option>
                                            @foreach($category_data as $cat_data)
                                            <option value="{{$cat_data->id}}">{{$cat_data->category_name}}</option>
                                            @endforeach 
                                        </select>
                                        
                                    </div>
                                </div>

                                {{Form::label('Sub Category Name')}}
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control sub_category" name="sub_category_id">
                                            <option disabled selected value> -- select first Category -- </option>
                                        </select>
                                    </div>
                                </div>

                                {{Form::label('Purchase Price')}}
                                <div class="form-group">
                                    <div class="form-line">
                                        {{Form::text('purchase_price','',['class'=>'form-control'])}}
                                    </div>
                                </div>

                                {{Form::label('Sale Price')}}
                                <div class="form-group">
                                    <div class="form-line">
                                        {{Form::text('sale_price','',['class'=>'form-control'])}}
                                    </div>
                                </div>

                                {{Form::label('Unit')}}
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control" name="unit_id">
                                            <option disabled selected value> -- select Unit -- </option>
                                            @foreach($unit_data as $unit_data)
                                            <option value="{{$unit_data->unit_id}}">{{$unit_data->unit_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{Form::label('Production Date')}}
                                <div class="form-group">
                                    <div class="form-line">
                                        {{Form::date('production_date','',['class'=>'form-control'])}}
                                    </div>
                                </div>

                                {{Form::label('Expired Date')}}
                                <div class="form-group">
                                    <div class="form-line">
                                        {{Form::date('expired_date','',['class'=>'form-control'])}}
                                    </div>
                                </div>

                                {{Form::label('Image')}}
                                <div class="form-group">
                                    <div class="form-line">
                                        {{Form::file('image',['class'=>'form-control img'])}}
                                    </div>
                                </div>
                                <div style="margin-bottom: 20px;">
                                    <img src="" class="img_show" width="200px" />
                                </div>
                                

                            {{Form::label('Status')}}
                                <div class="form-group">
                                    <div class="form-line">
                                    	{{Form::select("product_status",['1' => 'Active', '0' => 'Inactive'], null,["class" => "form-control"])}}
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
	$(document).ready(function() {

    $('.category').change(function(){
        var category_id= $('.category').val();
        
        $.ajax({
            url:'sub_category_ajax',
            type:'post',
            data:{ 
                '_token':'{{ csrf_token() }}', 'category_id':category_id},
            success:function(data)
            {   
                // console.log(data);
                if(data[0])
                {
                    $(".sub_category").html("");
                      for(var i=0;i<=data.length;i++)
                      {
                          $(".sub_category").append('<option value='+data[i].sub_category_id+'>'+data[i].sub_category_name+'</option>');
                      }
                }
                else
                {
                    $('.sub_category').html('');
                    $('.sub_category').append("<option>No Data Found</option>");   
                }
                
            }
        });
    }); 

    function readURL(input) {
    if (input.files && input.files[0]) 
    {
    var reader = new FileReader();

        reader.onload = function (e){
                $('.img_show').attr('src', e.target.result);
            }
        reader.readAsDataURL(input.files[0]);
        }

    }
    $(".img").change(function(){
    readURL(this);
    });


});
</script>
@endsection

