@extends('layouts.admin')
	@section('content')
	@include('alertas.request')
	{!!Form::model($area,['route'=>['area.update',$area],'method'=>'PUT'])!!}
		<h3>Actualización de áreas</h3>
		<div class="form-group">
			{!! Form::label('nombre','Nombre:')!!}
			{!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingresa el nombre del área']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('descripcion','Descripción:')!!}
			{!! Form::textarea('descripcion',null,['class'=>'form-control','placeholder'=>'Ingresa la descripcion del área']) !!}
		</div>

		{!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}

	{!!Form::open(['route'=>['area.destroy', $area], 'method' => 'DELETE'])!!}
			{!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
	{!!Form::close()!!}
	<br>
	<br>
	@endsection