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


<div class="container" style="  box-shadow: -5px 3px 18px -2px rgba(158,133,158,0.81);">
<div style="background: black; color: white; padding: 5px; margin-bottom: 50px;margin-top: 50px; font-weight: bold;"> Product Edit </div>

	{{Form::open(['url'=>'/product/'.$edit_data->product_id,'method'=>'put' ,'enctype'=>'multipart/form-data'])}}
		<div class="col-md-12">
			{{Form::label('Product Name')}}
            <div style="border: 1px solid #B3B3B3;">
  				{{Form::text('product_name',$edit_data->product_name,['class'=>'form-control'])}}
			</div>
		</div>
            

		<div class="col-md-12">
			{{Form::label('Category Name')}}
            <div style="border: 1px solid #B3B3B3;" >
                <select class="form-control category" name="category_id" >
                	<option value="{{$edit_data->id}}">{{$edit_data->C_name}}</option>
            		@foreach($category_data as $category_data)
							@if($category_data->id != $edit_data->id)
            				<option value="{{$category_data->id}}">{{$category_data->category_name}}</option>
            			@endif
            		@endforeach
                </select>
            </div>
		</div>

            
		<div class="col-md-12">
			{{Form::label('Sub Category Name')}}
            <div style="border: 1px solid #B3B3B3;">               
                <select class="form-control sub_category" name="sub_category_id" >
                	<option value="{{$edit_data->sub_category_id}}">{{$edit_data->sub_category_name}}</option>
                </select>
            </div>
		</div>

		
		<div class="col-md-6">
        	{{Form::label('Purchase Price')}}
            <div style="border: 1px solid #B3B3B3;">
               {{Form::text('purchase_price',$edit_data->purchase_price,['class'=>'form-control'])}}
            </div>
        </div>
		
		<div class="col-md-6">
	        {{Form::label('Sale Price')}}
	        <div class="form-group">
	            <div style="border: 1px solid #B3B3B3;">
	                {{Form::text('sale_price',$edit_data->sale_price,['class'=>'form-control'])}}
	            </div>
	        </div>
	    </div>
		
		<div class="col-md-6">
			{{Form::label('Production Date')}}
            <div style="border: 1px solid #B3B3B3;">
                {{Form::date('production_date',$edit_data->production_date,['class'=>'form-control'])}}
            </div>
		</div>

		<div class="col-md-6">
			{{Form::label('Expired Date')}}
            <div style="border: 1px solid #B3B3B3;">
                {{Form::date('expired_date',$edit_data->expired_date,['class'=>'form-control'])}}
            </div>
		</div>
            
        <div class="col-md-6">
			{{Form::label('Unit')}}
            <div style="border: 1px solid #B3B3B3;">
                <select class="form-control" name="unit_id">
	                <option value="{{$edit_data->unit_id}}">{{$edit_data->unit_name}}</option> 
					@foreach($unit_data as $unit_data)
						@if($unit_data->unit_id != $edit_data->unit_id)
							<option value="{{$unit_data->unit_id}}">{{$unit_data->unit_name}}</option>
						@endif
					@endforeach  
	                </select>
            </div>
		</div>

		<div class="col-md-3">
			{{Form::label('Status')}}
            <div style="border: 1px solid #B3B3B3;">
            	{{Form::select("product_status",['1' => 'Active', '0' => 'Inactive'], null,["class" => "form-control"])}}
            </div>
		</div>

		<div class="col-md-3">
			{{Form::label('Image')}}
            <div style="border: 1px solid #B3B3B3;">
                {{Form::file('image',['class'=>'form-control img'])}}
            </div>

            <div style="margin: 20px 0px;">
                <img src="{{asset('image_upload/'.$edit_data->image)}}" class="img_show" width="200px" />
            </div>
		</div>

        <div class="col-md-12" style="text-align: center; margin-bottom: 50px;">
         	{{Form::submit('Save',['class'=>'btn btn-success waves-effect'])}}
        </div>
        {{Form::close()}}
</div>	
	

<script type="text/javascript">
	
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



    $('.category').change(function(){
        var category_id= $('.category').val();
        var url='/sub_category_ajax';
     
        $.ajax({
            url:url,
            type:'post',
            data:{ 
                '_token':'{{ csrf_token() }}', 'category_id':category_id},
            success:function(data)
            {   
                console.log(data);
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

</script>
@endsection