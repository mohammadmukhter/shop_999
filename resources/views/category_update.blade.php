@extends('backend.backend')
@section('main_section')


@if($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach($errors->all() as $errors)
    <li>{{$errors}}</li>
    @endforeach
  </ul> 
</div>
@endif
                        {{Form::open(['url'=>'/category/'.$data->id,'method'=>'PUT'])}}
			                 {{Form::label('category_name')}}
			                   	<div class="form-group">
                                    <div class="form-line">
                          				{{Form::text('category_name',$data->category_name,['class'=>'form-control'])}}
									</div>
                                </div>

                            {{Form::label('category_description')}}
                            	<div class="form-group">
                                    <div class="form-line">
                                    	{{Form::text('category_description',$data->category_description,['class'=>'form-control'])}}
                                    </div>
                                </div>
                            {{Form::label('Status')}}
                                <div class="form-group">
                                    <div class="form-line">
                                        @if($data->category_status=='1')

                                    	{{Form::select("category_status",['1' => 'Active', '0' => 'Inactive'], null,["class" => "form-control"])}}

                                        @else

                                        {{Form::select("category_status",['0' => 'Inactive', '1' => 'Active'], null,["class" => "form-control"])}}

                                        @endif
                                    </div>
                                </div>

                             <div style="text-align: right;">

                             	{{Form::submit('Save',['class'=>'btn btn-success waves-effect'])}}
                             	
                             </div>
							
						{{Form::close()}}

@endsection