@extends('backend.backend')
@section('main_section')
	@include('backend.layouts.toastr')
{!! Toastr::message() !!}

		
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
                        	{{Form::open(['url'=>'/sale_create','method'=>'get'])}}
                        	{{Form::submit('POS',['class'=>'btn btn-info'])}}
                        	{{Form::close()}}
                        	</div>

                            <h2>
                                Sale List
                            </h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th> Sl </th>
                                            <th> Date </th>
                                            <th> Invoice No </th>
                                            <th> Customer </th>
                                            <th> Net Total </th>
                                            <th> Transaction Status </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                       <tr>
                                       	<td> 01 </td>
                                       	<td> Apple </td>
                                       	<td> 5416541451 </td>
                                       	<td> MR Dso </td>
                                       	<td> 240 </td>
                                       	<td> Paid </td>
                                       	<td> <button>details</button> </td>
                                       </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection