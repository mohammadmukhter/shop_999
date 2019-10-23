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
                        	<button type="button" class="btn btn-success waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal"> Add Category </button>
                        	</div>

                            <h2>
                                Category {{$ip}}
                            </h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Category Name</th>
                                            <th>Category Description</th>
                                            <th>Status</th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    	@foreach($category_data  as $key=> $data)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$data->category_name}}</td>
                                            <td>{{$data->category_description}}</td>

                                            @if($data->category_status==1)
                                            	<td> <span style="font-weight: bold;" class="text-success">Active</span> </td>
                                            @else
                                            	<td><span style="font-weight: bold;" class="text-danger"> Inactive </span></td>
                                            @endif

                                            <td style="display: inline-flex; "> 
                                            	{{Form::open(['url'=>'/category/'.$data->id,'method'=>'delete'])}}
                                            		{{Form::submit('Delete',['onclick'=>"return confirm('Are you Sure?')",'class'=>'btn btn-danger','style'=>'margin-right:5px;'])}}
                                            	{{Form::close()}}

                                            	{{Form::open(['url'=>'/category/'.$data->id.'/edit','method'=>'get'])}}
                                            		{{Form::submit('Edit',['class'=>'btn btn-warning edit_button','style'=>'margin-right:5px;'])}}
                                            	{{Form::close()}}

                                                @if($data->category_status=='1')
                                                    {{Form::open(['url'=>'/category/'.$data->id,'method'=>'GET'])}}
                                                    {{Form::submit('Inactive',['class'=>'btn btn-black','style'=>'margin-right:5px;'])}}
                                                    {{Form::close()}}
                                                @else                                               
                                                    {{Form::open(['url'=>'/category/'.$data->id,'method'=>'GET'])}}
                                                    {{Form::submit('Active',['class'=>'btn btn-success','style'=>'margin-right:5px;'])}}
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
                            <h4 class="modal-title" id="defaultModalLabel"> Add Category  </h4>
                        </div>
                        <div class="modal-body">

                        <div class="header">
                           
                        </div>
                        <div class="body">

			                 {{Form::open(['url'=>'/category','method'=>'post'])}}
			                 {{Form::label('category_name')}}
			                   	<div class="form-group">
                                    <div class="form-line">
                          				{{Form::text('category_name','',['class'=>'form-control'])}}
									</div>
                                </div>

                            {{Form::label('category_description')}}
                            	<div class="form-group">
                                    <div class="form-line">
                                    	{{Form::text('category_description','',['class'=>'form-control'])}}
                                    </div>
                                </div>
                            {{Form::label('Status')}}
                                <div class="form-group">
                                    <div class="form-line">
                                    	{{Form::select("category_status",['1' => 'Active', '0' => 'Inactive'], null,["class" => "form-control"])}}
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
@endsection



<!-- $(document).on("click",".edit_button",function(){

             var id=$(this).closest("tr").find("input[name=id]").val();
             var category_name=$(this).closest("tr").find("input[name=category_name]").val();
             var category_description=$(this).closest("tr").find("input[name=category_description]").val();
             var category_status=$(this).closest("tr").find("input[name=category_status]").val();

             alert(id);
             
});
 -->