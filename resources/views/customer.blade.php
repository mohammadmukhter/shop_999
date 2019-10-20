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
                        	<button type="button" class="btn btn-success waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal"> Add Customer </button>
                        	</div>

                            <h2>
                                Customer 
                            </h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th> Sl </th>
                                            <th> Customer Name </th>
                                            <th> Phone </th>
                                            <th> Email </th>
                                            <th> Address </th>
                                            <th> Image </th>
                                            <th> Status </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    @foreach($customer_data as $key=> $customer_data)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$customer_data->customer_name}}
                                                <input type="text" name="customer_id" value="{{$customer_data->customer_id}}" hidden="">
                                            </td>
                                            <td>{{$customer_data->customer_phone}}</td>
                                            <td>{{$customer_data->customer_email}}</td>
                                            <td>{{$customer_data->customer_address}}</td>
                                            <td>
                                                <img style="width: 100px;" src="{{asset('image_upload/'.$customer_data->image)}}">
                                            </td>
                                            @if($customer_data->customer_status=='1')
                                            <td><span style="font-weight: bold;" class="text-success">{{'Active'}}</span></td>
                                            @else
                                            <td><span style="font-weight: bold;" class="text-danger">{{'Inactive'}}</span></td>
                                            @endif

                                            <td style="display: inline-flex;">
                                                {{Form::open(['url'=>'/customer/'.$customer_data->customer_id,'method'=>'delete'])}}
                                                {{Form::submit('Delete',['class'=>'btn btn-warning ','onclick'=>"return confirm('Are You Sure?')" ,'style'=>'margin-right:5px;'])}}
                                                {{Form::close()}}


                                                <button type="button" class="btn btn-success waves-effect m-r-5 edit_id" data-toggle="modal" data-target="#edit_modal">Edit</button>

                                                @if($customer_data->customer_status=='0')

                                                {{Form::open(['url'=>'/customer/'.$customer_data->customer_id,'method'=>'get'])}}
                                                {{Form::submit('Active',['class'=>'btn btn-success'])}}
                                                {{Form::close()}}

                                                @else

                                                {{Form::open(['url'=>'/customer/'.$customer_data->customer_id,'method'=>'get'])}}
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
                            <h4 class="modal-title" id="defaultModalLabel"> Add Customer  </h4>
                        </div>
                        <div class="modal-body">

                        <div class="header">
                           
                        </div>
                        <div class="body">

			                 {{Form::open(['url'=>'/customer','method'=>'post','enctype'=>'multipart/form-data'])}}
			                 {{Form::label('Customer Name')}}
			                   	<div class="form-group">
                                    <div class="form-line">
                          				{{Form::text('customer_name','',['class'=>'form-control'])}}
									</div>
                                </div>

                            {{Form::label('Phone')}}
                                <div class="form-group">
                                    <div class="form-line">
                                        {{Form::text('customer_phone','',['class'=>'form-control'])}}
                                    </div>
                                </div>

                            {{Form::label('Email')}}
                                <div class="form-group">
                                    <div class="form-line">
                                        {{Form::email('customer_email','',['class'=>'form-control'])}}
                                    </div>
                                </div>

                            {{Form::label('Address')}}
                                <div class="form-group">
                                    <div class="form-line">
                                        {{Form::text('customer_address','',['class'=>'form-control'])}}
                                    </div>
                                </div>
                            
                            {{Form::label('Status')}}
                                <div class="form-group">
                                    <div class="form-line">
                                    	{{Form::select("customer_status",['1' => 'Active', '0' => 'Inactive'], null,["class" => "form-control"])}}
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
                            <h4 class="modal-title" id="defaultModalLabel"> Add Customer  </h4>
                        </div>
                        <div class="modal-body">

                        <div class="header">
                           
                        </div>
                        <div class="body">

                             {{Form::open(['url'=>'','enctype'=>'multipart/form-data', 'class'=>'edit_button','method'=>'put'])}}
                             {{Form::label('Customer Name')}}
                                <div class="form-group">
                                    <div class="form-line">
                                        {{Form::text('customer_name','',['class'=>'form-control customer'])}}
                                    </div>
                                </div>

                            {{Form::label('Phone')}}
                                <div class="form-group">
                                    <div class="form-line">
                                        {{Form::text('customer_phone','',['class'=>'form-control phone'])}}
                                    </div>
                                </div>

                            {{Form::label('Email')}}
                                <div class="form-group">
                                    <div class="form-line">
                                        {{Form::email('customer_email','',['class'=>'form-control email'])}}
                                    </div>
                                </div>

                            {{Form::label('Address')}}
                                <div class="form-group">
                                    <div class="form-line">
                                        {{Form::text('customer_address','',['class'=>'form-control address'])}}
                                    </div>
                                </div>
                            
                            {{Form::label('Status')}}
                                <div class="form-group">
                                    <div class="form-line">
                                       <select name="customer_status" class="form-control customer_status"></select>
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

        
        var edit_id=$(this).closest('tr').find("input[name=customer_id]").val();

        var route_path="/customer/"+edit_id;
        $('.edit_button').attr('action',route_path);

        $.ajax({

            url:'customer_ajax_data',
            type:'post',
            data:{

                '_token': '{{ csrf_token() }}',
                'edit_id':edit_id,
            },
            success:function(data)
            {
                console.log(data);

                $('.customer').val(data.customer_name);
                $('.phone').val(data.customer_phone);
                $('.email').val(data.customer_email);
                $('.address').val(data.customer_address);
                    
                if(data.customer_status==1)
                {

                    $('.customer_status').html("");
                    $('.customer_status').append("<option value='1'>Active</option>");
                    $('.customer_status').append("<option value='0'>Inactive</option>");
                    
                }
                else
                {
                    $('.customer_status').html("");
                    $('.customer_status').append("<option value='0'>Inactive</option>");
                    $('.customer_status').append("<option value='1'>Active</option>");
                }
                var image_path="{{asset('image_upload')}}/"+data.image;
                $('.img_show').attr('src',image_path);
            }
        });
    });



</script>

@endsection