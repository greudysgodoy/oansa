@extends('layouts.admin')
	@include('alertas.success')
	@section('content')
	

	{!!Form::open(['route'=>'manual.store', 'method'=>'POST'],['class'=>'form-horizontal'])!!}
		<h3>Asignacion de manuales</h3>
		
		<div class="form-group">
			<table class="table">
		<thead>
			<th>Oansista:</th>
			<th>Club</th>
		</thead>
		@foreach($oansistas->get() as $oansista)
			<tbody>
				<td>{{$oansista->fullname}}</td>
				{!! Form::hidden('oansista_id', $oansista->id) !!}
				<td>
				@if($oansista->grado < 4)
					Chispas
					@elseif($oansista->grado < 6)
						Llamas
					@else
						Antorchas
				@endif
				</td>
			</tbody>
		@endforeach
	</table>
		<div class="form-group">
			{!! Form::label('nivel_id','Nivel del manual:') !!}
			{!! Form::select('nivel',config('options.manuales'),null, ['class'=>'form-control']) !!}
		</div>
			
	{!!Form::submit('Asignar',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
	
	@endsection