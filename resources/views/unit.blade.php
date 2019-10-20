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

<div style="text-align: right; margin-bottom: 10px;">
	<button type="button" class="btn btn-success waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal"> Add + </button>
</div>


 <table id="unit_table" class="table table-bordered" style="width:100%;">
        <thead style="background: #6686FC;">
            <tr>
            	<th>Sl</th>
                <th>Unit Name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody> 

        @foreach($unit_data as $key=> $value)          
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$value->unit_name}}

                	<input type="text" name="unit_id" value="{{$value->unit_id}}" hidden="">
                </td>
                @if($value->unit_status=='0')
                	<td><span style="font-weight: bold;" class="text-danger"> Inactive </span></td>
                @else
                	<td> <span style="font-weight: bold;" class="text-success">Active</span> </td>
                @endif

                <td style="display: inline-flex;">
                	{{Form::open(['url'=>'/unit/'.$value->unit_id,'method'=>'delete'])}}
                	{{Form::submit('Delete',['class'=>'btn btn-warning', 'onclick'=>"return confirm('Are you Sure?')", 'style'=>'margin-right:5px;'])}}
                	{{Form::close()}}

                	<button type="button" class="btn btn-info edit_id" data-toggle="modal" data-target="#eidt_form" style="margin-right: 5px;"> Edit</button>

                	@if($value->unit_status=='0')
                	{{Form::open(['url'=>'/unit/'.$value->unit_id,'method'=>'get'])}}
                	{{Form::submit('Active',['class'=>'btn btn-success', 'style'=>'margin-right:5px;'])}}
                	{{Form::close()}}
                	@else
                	{{Form::open(['url'=>'/unit/'.$value->unit_id,'method'=>'get'])}}
                	{{Form::submit('Inactive',['class'=>'btn btn-danger', 'style'=>'margin-right:5px;'])}}
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
                            <h4 class="modal-title" id="defaultModalLabel"> Add Product  </h4>
                        </div>
                        <div class="modal-body">

                        <div class="body">

			                 {{Form::open(['url'=>'/unit','method'=>'post'])}}
			                 {{Form::label('Unit Name')}}
			                   	<div class="form-group">
                                    <div class="form-line">
                          				{{Form::text('unit_name','',['class'=>'form-control'])}}
									</div>
                                </div>

                            {{Form::label('Status')}}
                                <div class="form-group">
                                    <div class="form-line">
                                    	{{Form::select("unit_status",['1' => 'Active', '0' => 'Inactive'], null,["class" => "form-control"])}}
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



<div class="modal fade" id="eidt_form" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel"> Add Product  </h4>
                        </div>
                        <div class="modal-body">

                        <div class="body">

			                 {{Form::open(['method'=>'put', 'class'=>'edited'])}}
			                 {{Form::label('Unit Name')}}
			                   	<div class="form-group">
                                    <div class="form-line">
                          				{{Form::text('unit_name','',['class'=>'form-control unit_name'])}}
									</div>
                                </div>

                            {{Form::label('Status')}}
                                <div class="form-group">
                                    <div class="form-line">
                                    	<select class="form-control unit_status" name="unit_status">
                                    		
                                    	</select>
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
    $('#unit_table').DataTable();


   	$(document).on("click",".edit_id",function(){
    	var edit_id=$(this).closest("tr").find("input[name=unit_id]").val();
    	var url= '/unit/'+edit_id;
    	$('.edited').attr('Action',url);

    	$.ajax({
            url:'unit_ajax',
            type:'post',
            data:{
                "_token": "{{ csrf_token() }}",
                "edit_id":edit_id,
            },
           success:function(data)
           {    
            $('.unit_name').val(data.unit_name);

            $('.unit_status').html('');
	            if(data.unit_status=='1')
	            {
	            	$('.unit_status').append("<option value='1'>Active</option>");
	            	$('.unit_status').append("<option value='0'>Inactive</option>");
	            }
	            else
	            {
	            	$('.unit_status').append("<option value='0'>Inactive</option>");
	            	$('.unit_status').append("<option value='1'>Active</option>");
	            }

           }
        });
    });
});
</script>

@endsection