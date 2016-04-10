@extends('layouts.admin')
	@section('content')
	@include('alertas.request')
	{!!Form::open(['route'=>'area.store', 'method'=>'POST'],['class'=>'form-horizontal'])!!}
		<h3>Registro de áreas</h3>
		<div class="form-group">
			{!! Form::label('nombre','Nombre:')!!}
			{!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingresa el nombre del área']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('descripcion','Descripción:')!!}
			{!! Form::textarea('descripcion',null,['class'=>'form-control','placeholder'=>'Ingresa la descripcion del área']) !!}
		</div>

		{!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
	<br>
	<br>
	@endsection