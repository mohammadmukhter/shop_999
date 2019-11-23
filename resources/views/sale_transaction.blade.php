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

                            <h2 style="color: #000; font-size: 25px; font-weight: bold; text-shadow: 2px 2px 2px #CE5937;">
                                SALES TRANSACTION
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
                                            <th> Paid </th>
                                            <th> Transaction Status </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach($sale_transaction as $key=> $sale_transaction)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$sale_transaction->created_at->format('m/d/Y')}}</td>
                                            <td>{{$sale_transaction->sale_invoice_code}}
                                                <input type="hidden" name="sale_invoice_code" class="sale_invoice_code" value="{{$sale_transaction->sale_invoice_code}}">
                                            </td>
                                            <td>{{$sale_transaction->customer_name}}</td>
                                            <td>{{$sale_transaction->sale_net_total}}</td>
                                            <td>{{$sale_transaction->sale_paid}}</td>
                                            @if($sale_transaction->sale_transaction_status == 0)
                                            <td> <span style="color: red; font-weight: bold;"> Due </span> </td>
                                            @else
                                            <td> <span style="color: green; font-weight: bold;"> Paid </span> </td>
                                            @endif

                                            <td style="display: inline-flex;">
                                                {{Form::open(['url'=>'/sale_list/'.$sale_transaction->sale_invoice_code,'method'=>'get'])}}
                                                {{Form::submit('Details',['class'=>'btn btn-info sale_details'])}}
                                                {{Form::close()}}

                                                {{Form::open(['url'=>"/sale_invoice/".$sale_transaction->sale_invoice_code,'method'=>'get'])}}
                                                    {{Form::submit('Invoice',['class'=>'btn btn-warning invoice_popup'])}}
                                                    {{Form::close()}}
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


    <script type="text/javascript">
        
        $('.invoice_popup').click(function(e){
        e.preventDefault();
        var s_data= $(this).closest('tr').find('.sale_invoice_code').val();
        var s_url= '/sale_invoice/'+s_data;
        window.open(s_url, 'mywindow', 'width=1120, height=1200');
        });

    </script>
@endsection