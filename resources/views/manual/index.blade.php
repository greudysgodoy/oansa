@extends('layouts.admin')
	@include('alertas.success')
	@section('content')
	
	{!! Form::label('Seleccione un Oansista') !!}
	{!!Form::model(Request::all(), ['route'=>'manual.index', 'method'=>'GET','class'=>'navbar-form navbar-left pull-right', 'role'=>'search'])!!}
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
					{!!Form::open(['route'=>'manual.create', 'method'=>'GET','class'=>'navbar-form navbar-left pull-right', 'role'=>'search'])!!}
  						{!! Form::hidden('oansista_id', $oansista->id) !!}
  					{!!Form::submit('Seleccionar',['class'=>'btn btn-primary'])!!}
  	{!! Form::close() !!}
					
				</td>
			</tbody>
		@endforeach
	</table>
	@endsection