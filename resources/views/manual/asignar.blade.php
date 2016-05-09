@extends('layouts.admin')
	@section('content')
	@include('alertas.request')
	{!!Form::open(['route'=>'manual.store', 'method'=>'POST'],['class'=>'form-horizontal'])!!}
		<h3>Asignacion de manuales</h3>
		<div class="form-group">
			{!! Form::label('oansista_id','Oansista:') !!}
			{!! Form::select('oansista_id',$oansistas) !!}
		</div>
		<div class="form-group">
			{!! Form::label('nivel','Nivel del manual:') !!}
			{!! Form::select('nivel',config('options.manuales'),null, ['class'=>'form-control']) !!}
		</div>
			
	{!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
	
	@endsection