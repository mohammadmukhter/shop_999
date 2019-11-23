@extends('backend.backend')
@section('main_section')

<div style="background: black; color: #fff; padding: 10px 10px; font-size: 20px; font-weight: bold;">
	Stock Report
</div>
<div class="panel" style="height: 100px;">
	<div style="margin:10px 20px;">

	{{Form::open(['url'=>'/stock_show','method'=>'post'])}}

 	<label> Category Name :</label>
 	<select name="category_name" style="border: 1px solid #C6CAC6; background: #FEFFFE; padding: 2px 5px; border-radius: 5%; width: 150px; margin-right: 10px;">\
 		<option disabled selected value>Select Category</option>
 		<option>  </option>
 	</select>
	 
	<label> Product Name :</label>
	<select name="product_name" style="border: 1px solid #C6CAC6; background: #FEFFFE; padding: 2px 5px; border-radius: 5%; width: 150px; margin-right: 10px;">
	 	<option disabled selected value>Select Product</option>
	 	@foreach($product_name as $product_name_value)
	 	<option value="{{$product_name_value->product_id}}">{{$product_name_value->product_name}}</option>
	 	@endforeach
	</select>

	<label> Product Code :</label>
	<input type="text" name="product_code" style="border: 1px solid #C6CAC6; background: #FEFFFE; padding: 2px 5px; border-radius: 5%; width: 150px; margin-right: 10px;">

	<button class="btn btn-info">Show</button>

	<div style="margin-top: 10px;">
	<label> Product Type :</label>
	<select name="product_type" style="border: 1px solid #C6CAC6; background: #FEFFFE; padding: 2px 5px; border-radius: 5%; width: 150px; margin-right: 10px;">
		<option disabled selected value>Select Product</option>
		<option value="1">Available</option>
		<option value="0">Sold</option>
		<option value="2">Return</option>
	</select>
	</div>

	{{Form::close()}}

	</div>
</div>

<div class="panel">
	<table style="width: 100%;">
	<thead>
		<tr style="background: #B9BBB9;">
			<th style="border: 1px solid #373837; padding: 0px 100px; text-align: center;">Product</th>
			<th style="border: 1px solid #373837; padding: 0px 100px; text-align: center;">Stock</th>
			<th style="border: 1px solid #373837; padding: 0px 100px; text-align: center;">Stock Status</th>
		</tr>
	</thead>

	<tbody>
		@if($products)
			@foreach($products as $products_data)
				@php 
				$stock_get=collect($stock_product)
				->where('product_id',$products_data->product_id);
				$stock_count=count($stock_get);
				$stock_id=0;
				@endphp
				@foreach($stock_get as $stock_get_data)
					@if($stock_id==0)
					<tr>
						<td style="text-align:center; padding: 0px 100px; border: 1px solid #373837;" rowspan="{{$stock_count}}">{{$products_data->product_name}}</td>
						<td style="border: 1px solid #373837; padding: 0px 100px;">{{$stock_get_data['stock_code']}}</td>
						@if($stock_get_data['stock_status'] == 0)
						<td style="border: 1px solid #373837; padding: 0px 100px;"><span style="color: red; font-weight: bold;">Sold</span></td>
						@elseif($stock_get_data['stock_status'] == 2)
						<td style="border: 1px solid #373837; padding: 0px 100px;"><span style="color: #950183; font-weight: bold;">Returned</span></td>
						@else
						<td style="border: 1px solid #373837; padding: 0px 100px;"><span style="color: green; font-weight: bold;">Available</span></td>
						@endif
					</tr>
					@else
					<tr>
						<td style="border: 1px solid #373837; padding: 0px 100px;">{{$stock_get_data['stock_code']}}</td>
						@if($stock_get_data['stock_status'] == 0)
						<td style="border: 1px solid #373837; padding: 0px 100px;"><span style="color: red; font-weight: bold;">Sold</span></td>
						@elseif($stock_get_data['stock_status'] == 2)
						<td style="border: 1px solid #373837; padding: 0px 100px;"><span style="color: #950183; font-weight: bold;">Returned</span></td>
						@else
						<td style="border: 1px solid #373837; padding: 0px 100px;"><span style="color: green; font-weight: bold;">Available</span></td>
						@endif
					</tr>
					@endif
					@php $stock_id++; @endphp
				@endforeach
			@endforeach
		@endif
	</tbody>
	</table>
</div>


@endsection