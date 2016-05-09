@extends('layouts.admin')
	@include('alertas.success')
	@section('content')
	
	{!!Form::model(Request::all(), ['route'=>'oansista.index', 'method'=>'GET','class'=>'navbar-form navbar-left pull-right', 'role'=>'search'])!!}
  		<div class="form-group">
    		{!! Form::text('fullname',null,['class'=>'form-control','placeholder'=>'Nombre del oansista']) !!}
    		{!! Form::select('club_id',config('options.clubes'),null, ['class'=>'form-control']) !!}
  		</div>

  		{!!Form::submit('Buscar',['class'=>'btn btn-default'])!!}
  	{!! Form::close() !!}
	
	<table class="table">
		<thead>
			<th>Nombres</th>
			<th>Apellidos</th>
			<th>Club</th>
		</thead>
		@foreach($oansistas as $oansista)
			<tbody>
				<td>{{$oansista->nombre}}</td>
				<td>{{$oansista->apellido}}</td>
				<td>
				@if($oansista->grado < 4)
					Chispas
					@elseif($oansista->grado < 6)
						Llamas
					@else
						Antorchas
				@endif

				</td>
				
				<td>
					{!!link_to_route('oansista.edit', $title = 'Editar', $parameters = $oansista->id, $attributes = ['class'=>'btn btn-primary'])!!}
					
				</td>
			</tbody>
		@endforeach
	</table>
	@endsection