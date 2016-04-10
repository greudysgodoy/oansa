@extends('layouts.admin')
	@section('content')
	@include('alertas.request')
	{!!Form::open(['route'=>'oansista.store', 'method'=>'POST'],['class'=>'form-horizontal'])!!}
		<h3>Registro de oansistas</h3>
		<div class="form-group">
			{!! Form::label('nombre','Nombre:')!!}
			{!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingresa el Nombre del oansista']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('apellido','Apellido:')!!}
			{!! Form::text('apellido',null,['class'=>'form-control','placeholder'=>'Ingresa el Apellido del oansista']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('fechaNacimiento','Fecha de nacimiento:')!!}
			{!! Form::date('fechaNacimiento',null,array('class'=>'form-control')) !!}
		</div>
		<div class="form-group">
			{!! Form::label('grado','Grado escolar:')!!}
			{!! Form::selectRange('grado', 1, 7, 1) !!}
		</div>
		<div class="form-group">
			{!! Form::label('sexo','Sexo:')!!}
			<br>
			{!! Form::label('femenino','Femenino:')!!}
			{!! Form::radio('sexo', 'f') !!}
			{!! Form::label('masculino','Masculino:')!!}
			{!! Form::radio('sexo', 'm') !!}
		</div>
		<div class="form-group">
			{!! Form::label('direccion','Direccion:')!!}
			{!! Form::text('direccion',null,['class'=>'form-control','placeholder'=>'Direccion del oansista']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('telefono','Telefono:')!!}
			{!! Form::text('telefono',null,['class'=>'form-control','placeholder'=>'Numero de telefono del oansista']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('representante','Nombre del representante:')!!}
			{!! Form::text('representante',null,['class'=>'form-control','placeholder'=>'Nombre del representante']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('telefonoRepresentante','Telefono del representante:')!!}
			{!! Form::text('telefonoRepresentante',null,['class'=>'form-control','placeholder'=>'Telefono del representante']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('iglesia','Iglesia:')!!}
			{!! Form::text('iglesia',null,['class'=>'form-control','placeholder'=>'Iglesia a la que pertenece']) !!}
		</div>

		{!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
	<br>
	<br>
	@endsection