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
                        	<button type="button" class="btn btn-success waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal"> Add Supplier </button>
                        	</div>

                            <h2>
                                Supplier 
                            </h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Supplier Name</th>
                                            <th>Company Name</th>
                                            <th>Email</th>
                                            <th> Phone </th>
                                            <th> Address </th>
                                            <th> Image </th>
                                            <th> Status </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                               			@foreach($supplier_data as $key=> $supplier_data)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$supplier_data->supplier_name}}
                                            	<input type="text" name="supplier_id" value="{{$supplier_data->supplier_id}}" hidden="">
                                            </td>
                                            <td>{{$supplier_data->company_name}}</td>
                                            <td>{{$supplier_data->supplier_email}}</td>
                                            <td>{{$supplier_data->supplier_phone}}</td>
                                            <td>{{$supplier_data->supplier_address}}</td>
                                            <td><img style="width: 100px;" src="{{asset('image_upload/'.$supplier_data->image)}}"></td>

                                            @if($supplier_data->supplier_status=='0')
                                            <td><span style="font-weight: bold;" class="text-danger">{{'Inactive'}}</span></td>
                                            @else
                                            <td><span style="font-weight: bold;" class="text-success">{{'Active'}}</span></td>
                                            @endif

                                            <td style="display: inline-flex;">
                                            	{{Form::open(['url'=>'/supplier/'.$supplier_data->supplier_id,'method'=>'delete'])}}
                                            	{{Form::submit('Delete',['class'=>'btn btn-warning ','onclick'=>"return confirm('Are You Sure?')" ,'style'=>'margin-right:20px;'])}}
                                            	{{Form::close()}}


                                            	<button type="button" class="btn btn-success waves-effect m-r-20 edit_id" data-toggle="modal" data-target="#edit_modal">Edit</button>

                                            	@if($supplier_data->supplier_status=='0')

                                            	{{Form::open(['url'=>'/supplier/'.$supplier_data->supplier_id,'method'=>'get'])}}
                                            	{{Form::submit('Active',['class'=>'btn btn-success'])}}
                                            	{{Form::close()}}

                                            	@else

                                            	{{Form::open(['url'=>'/supplier/'.$supplier_data->supplier_id,'method'=>'get'])}}
                                            	{{Form::submit('Inactive',['class'=>'btn btn-danger'])}}
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
                            <h4 class="modal-title" id="defaultModalLabel"> Add Supplier  </h4>
                        </div>
                        <div class="modal-body">

                        <div class="header">
                           
                        </div>
                        <div class="body">

			                {{Form::open(['url'=>'/supplier','method'=>'post','enctype'=>'multipart/form-data'])}}
			                {{Form::label('Supplier Name')}}
			                   	<div class="form-group">
                                    <div class="form-line">
                          				{{Form::text('supplier_name','',['class'=>'form-control'])}}
									</div>
                                </div>

                            {{Form::label('Company Name')}}
			                   	<div class="form-group">
                                    <div class="form-line">
                          				{{Form::text('company_name','',['class'=>'form-control'])}}
									</div>
                                </div>

                            {{Form::label('Email')}}
			                   	<div class="form-group">
                                    <div class="form-line">
                          				{{Form::email('supplier_email','',['class'=>'form-control'])}}
									</div>
                                </div>

                            {{Form::label('Phone')}}
			                   	<div class="form-group">
                                    <div class="form-line">
                          				{{Form::text('supplier_phone','',['class'=>'form-control'])}}
									</div>
                                </div>
                            
                            {{Form::label('Address')}}
			                   	<div class="form-group">
                                    <div class="form-line">
                          				{{Form::textarea('supplier_address','',['class'=>'form-control', 'style'=>'height:100px;'])}}
									</div>
                                </div>

                            {{Form::label('Status')}}
                                <div class="form-group">
                                    <div class="form-line">
                                    	{{Form::select("supplier_status",['1' => 'Active', '0' => 'Inactive'], null,["class" => "form-control"])}}
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



<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel"> Add Supplier  </h4>
                        </div>
                        <div class="modal-body">

                        <div class="header">
                           
                        </div>
                        <div class="body">

			                {{Form::open(['url'=>'','method'=>'put','enctype'=>'multipart/form-data', 'class'=>'edit_submit'])}}
			                {{Form::label('Supplier Name')}}
			                   	<div class="form-group">
                                    <div class="form-line">
                          				{{Form::text('supplier_name','',['class'=>'form-control supplier_name'])}}
									</div>
                                </div>

                            {{Form::label('Company Name')}}
			                   	<div class="form-group">
                                    <div class="form-line">
                          				{{Form::text('company_name','',['class'=>'form-control company_name'])}}
									</div>
                                </div>

                            {{Form::label('Email')}}
			                   	<div class="form-group">
                                    <div class="form-line">
                          				{{Form::email('supplier_email','',['class'=>'form-control supplier_email'])}}
									</div>
                                </div>

                            {{Form::label('Phone')}}
			                   	<div class="form-group">
                                    <div class="form-line">
                          				{{Form::text('supplier_phone','',['class'=>'form-control supplier_phone'])}}
									</div>
                                </div>
                            
                            {{Form::label('Address')}}
			                   	<div class="form-group">
                                    <div class="form-line">
                          				{{Form::textarea('supplier_address','',['class'=>'form-control supplier_address', 'style'=>'height:100px;'])}}
									</div>
                                </div>

                            {{Form::label('Status')}}
                                <div class="form-group">
                                    <div class="form-line">
                                    	<select name="supplier_status" class="form-control supplier_status"></select>
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


$(document).on('click','.edit_id',function(){

	var edit_id= $(this).closest('tr').find("input[name=supplier_id]").val();
	var attr_url='/supplier/'+edit_id;
	$('.edit_submit').attr('action',attr_url);

	$.ajax({
		url:'supplier_edit_ajax',
		type:'post',
		data:{
                "_token": "{{ csrf_token() }}",
                "edit_id":edit_id,
            },

		success:function(data)
		{
			//console.log(data);
			$('.supplier_name').val(data.supplier_name);
			$('.company_name').val(data.company_name);
			$('.supplier_email').val(data.supplier_email);
			$('.supplier_phone').val(data.supplier_phone);
			$('.supplier_address').val(data.supplier_address);
			
			if(data.supplier_status=='0')
			{
				$('.supplier_status').html("");
				$('.supplier_status').append("<option value='0'>Inactive</option>");
				$('.supplier_status').append("<option value='1'>Active</option>");
			}
			else
			{
				$('.supplier_status').html("");
				$('.supplier_status').append("<option value='1'>Active</option>");
				$('.supplier_status').append("<option value='0'>Inactive</option>");
			}
            var path="{{asset('image_upload/')}}/"+data.image;
            //console.log(path);
            $('.img_show').attr('src',path);


		}

	});
});


</script>

@endsection