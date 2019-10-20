@extends('backend.backend')
@section('main_section')
		
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
                        	{{Form::open(['url'=>'/purchase_create','method'=>'get'])}}
                        	{{Form::submit('Create New Purchase',['class'=>'btn btn-success'])}}
                        	{{Form::close()}}
                        	</div>

                            <h2>
                                Purchase List
                            </h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th> Sl </th>
                                            <th> Date </th>
                                            <th> Voucher No </th>
                                            <th> Supplier </th>
                                            <th> Net Total </th>
                                            <th> Paid Total </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    	<tr>
                                    		<td>01</td>
                                    		<td>12/12/2019</td>	
                                    		<td>6188888888</td>
                                    		<td>Mr. kY</td>
                                    		<td>4000</td>
                                    		<td>2000</td>
                                    		<td><button>Details</button></td>
                                    	</tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection