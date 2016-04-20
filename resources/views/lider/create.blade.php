@extends('layouts.admin')
	@section('content')
	@include('alertas.request')
	{!!Form::open(['route'=>'lider.store', 'method'=>'POST'],['class'=>'form-horizontal'])!!}
		<h3>Registro de líderes</h3>
		<div class="form-group">
			{!! Form::label('cedula','Cédula:')!!}
			{!! Form::text('cedula',null,['class'=>'form-control','placeholder'=>'Ingresa la cédula del líder']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('nombre','Nombre:')!!}
			{!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingresa el nombre del líder']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('apellido','Apellido:')!!}
			{!! Form::text('apellido',null,['class'=>'form-control','placeholder'=>'Ingresa el apellido del líder']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('fechaNacimiento','Fecha de nacimiento:')!!}
			{!! Form::date('fechaNacimiento',null,array('class'=>'form-control')) !!}
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
			{!! Form::label('telefono','Teléfono:')!!}
			{!! Form::text('telefono',null,['class'=>'form-control','placeholder'=>'Número de teléfono']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('email','Email:')!!}
			{!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Dirección de correo electrónico']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('password','Contraseña:')!!}
			{!! Form::password('password',['class'=>'form-control','placeholder'=>'Ingresa una contraseña']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('liderGdc','Nombre del líder de Gdc:')!!}
			{!! Form::text('liderGdc',null,['class'=>'form-control','placeholder'=>'Nombre del líder de Gdc']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('telefonoLiderGdc','Teléfono del líder de Gdc:')!!}
			{!! Form::text('telefonoLiderGdc',null,['class'=>'form-control','placeholder'=>'Teléfono del líder de Gdc']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('area_Id','Área del club:') !!}
			{!! Form::select('area_Id',$areas) !!}
		</div>
		<div class="form-group">
			{!! Form::label('rol_Id','Rol que desempeña en el club:') !!}
			{!! Form::select('rol_Id',$roles) !!}
		</div>
		
		
		

		{!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
	<br>
	<br>
	@endsection