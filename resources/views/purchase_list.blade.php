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
                                            <th> Transaction Status </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach($purchase_transaction_data as $key => $p_t_data)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$p_t_data->created_at->format('m/d/Y')}}</td>
                                                <td>{{$p_t_data->purchase_voucher_code}}
                                                <input type="text" hidden class="purchase_voucher_code" value="{{$p_t_data->purchase_voucher_code}}">
                                                </td>
                                                <td>{{$p_t_data->supplier_name}}</td>
                                                <td>{{$p_t_data->purchase_net_price}}</td>
                                                @if($p_t_data->purchase_transaction_status==1)
                                                <td><span class="text-success" style="font-weight: bold;"><i class="fa fa-check-circle"></i>&nbsp;Paid</span></td>
                                                @else
                                                <td><span class="text-danger" style="font-weight: bold;"><i class="fa fa-exclamation-circle"></i>&nbsp;Due</span></td>
                                                @endif
                                                
                                                <td>
                                                    {{Form::open(['class'=>'url_class','url'=>'','method'=>'get'])}}
                                                    {{Form::submit('Details',['class'=>'btn btn-info purchase_transaction_details'])}}
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
    $(document).on('click','.purchase_transaction_details',function(){
        var purchase_voucher= $(this).closest('tr').find('.purchase_voucher_code').val();
        var url= '/purchase_list/'+purchase_voucher;
        $('.url_class').attr('action',url);
    });
</script>

@endsection