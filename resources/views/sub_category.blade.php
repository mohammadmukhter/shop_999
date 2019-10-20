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
                            <button type="button" class="btn btn-success waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal"> Add Sub Category </button>
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
                                            <th>Category Name</th>
                                            <th>Sub Category Name</th>
                                            <th>Sub Category Description</th>
                                            <th>Status</th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    	@foreach($sub_category_data as $key=> $value)
                                        <tr>
                                           <td>{{$key+1}}</td>
                                           <td>{{$value->category_name}}</td>

                                           <td>{{$value->sub_category_name}}
                                            <input type="text" name="sub_category_id" value="{{$value->sub_category_id}}" hidden="">
                                           </td>
                                           <td>{{$value->sub_category_description}}</td>

                                           @if($value->sub_category_status=='1')
                                           <td><span class="text-success" style="font-weight: bold;" >{{'Active'}}</span></td>
                                           @else
                                           <td><span class="text-danger" style="font-weight: bold;" >{{'Inactive'}}</span></td>
                                           @endif
                                           <td style="display:inline-flex;">
                                               
                                               {{Form::open(['url'=>'/sub_category/'.$value->sub_category_id,'method'=>'delete'])}}
                                                 {{Form::submit('Delete',['class'=>'btn btn-warning','onclick' =>"return confirm('Are you sure?')"])}}
                                               {{Form::close()}}
                                    
                                                    <button type="button" class="btn btn-info edit_id" data-toggle="modal" data-target="#edit_modal" > Edit </button>

                                                @if($value->sub_category_status=='1')
                                                {{Form::open(['url'=>'/sub_category/'.$value->sub_category_id,'method'=>'get'])}}
                                                {{Form::submit('Inactive',['class'=>'btn btn-danger'])}}
                                                {{Form::close()}}

                                                @else
                                                {{Form::open(['url'=>'/sub_category/'.$value->sub_category_id,'method'=>'get'])}}
                                                {{Form::submit('Active',['class'=>'btn btn-success'])}}
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
                            <h4 class="modal-title" id="defaultModalLabel"> Add Sub Category</h4>
                        </div>
                        <div class="modal-body">

                        <div class="header">
                           
                        </div>
                        <div class="body">

			                 {{Form::open(['url'=>'/sub_category','method'=>'post'])}}
			                 {{Form::label('sub_category_name')}}
			                   	<div class="form-group">
                                    <div class="form-line">
                          				{{Form::text('sub_category_name','',['class'=>'form-control'])}}
									</div>
                                </div>

                            {{Form::label('category_name')}}
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="category_name" class="form-control">
                                            <option>----select----</option>
                                            @foreach($category_name_data as $data)
                                                <option value="{{$data->id}}">{{$data->category_name}}</option>
                                            @endforeach
                                        </select>   
                                    </div>
                                </div>

                            {{Form::label('sub_category_description')}}
                            	<div class="form-group">
                                    <div class="form-line">
                                    	{{Form::text('sub_category_description','',['class'=>'form-control'])}}
                                    </div>
                                </div>
                            {{Form::label('Status')}}
                                <div class="form-group">
                                    <div class="form-line">
                                    	{{Form::select("sub_category_status",['1' => 'Active', '0' => 'Inactive'], null,["class" => "form-control"])}}
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



<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel"> Edit Sub Category</h4>
                        </div>
                        <div class="modal-body">

                        <div class="header">
                           
                        </div>
                        <div class="body">

                             {{Form::open(['method'=>'put','class'=>'sub_id'])}}
                             {{Form::label('sub_category_name')}}
                                <div class="form-group">

                                    <div class="form-line">
                                        {{Form::text('sub_category_name','',['class'=>'form-control sub_category'])}}

                                    </div>
                                </div>

                            {{Form::label('category_name')}}
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="category_name" class="form-control category">
                                            <option></option>
                                        </select>   
                                    </div>
                                </div>

                            {{Form::label('sub_category_description')}}
                                <div class="form-group">
                                    <div class="form-line">
                                        {{Form::text('sub_category_description','',['class'=>'form-control sub_category_description'])}}
                                    </div>
                                </div>
                            {{Form::label('Status')}}
                                <div class="form-group">
                                    <div class="form-line">
                                       <select class="form-control status" name="sub_category_status">
                                        <option></option>>
                                           
                                       </select>
                                    </div>
                                </div>

                             <div style="text-align: right;">

                                {{Form::submit('Update',['class'=>'btn btn-success waves-effect'])}}
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
        
    $(document).on("click",".edit_id",function(){
        var edit_id=$(this).closest("tr").find("input[name=sub_category_id]").val();

        var url='sub_category/'+edit_id;
        $(".sub_id").attr('action',url);

        $.ajax({
            url:'sub_category_ajax',
            type:'post',
            data:{
                "_token": "{{ csrf_token() }}",
                "edit_id":edit_id,
            },
           success:function(data)
           {    
            // console.log(data);
                $(".category").html("");
                $('.sub_category').val(data[0].sub_category_name);
                $('.sub_category_description').val(data[0].sub_category_description);

                $('.subid').val(data[0].sub_category_id);

                $(".category").append("<option value="+data[0].id+">"+data[0].category_name+"</option>");
                for(var i=0;i<data[1].length;i++)
                {
                    if(data[1][i].id!=data[0].id)
                    {
                        $(".category").append("<option value="+data[1][i].id+">"+data[1][i].category_name+"</option>");     
                    } 
                }


                $('.status').html("");
                if(data[0].sub_category_status=='0')
                {
                    $('.status').append("<option value='0'> Inactive </option>");
                    $('.status').append("<option value='1'> Active </option>");
                }
                else
                {
                    $('.status').append("<option value='1'> Active </option>");
                    $('.status').append("<option value='0'> Inactive </option>");
                }
                

           }
        });
    });
    
});
</script>



@endsection