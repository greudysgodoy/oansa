@extends('layouts.admin')
	@include('alertas.success')
	@section('content')
	<table class="table">
		<thead>
			<th>Rol</th>
			<th>Descripción</th>
		</thead>
		@foreach($roles as $rol)
			<tbody>
				<td>{{$rol->nombre}}</td>
				<td>{{$rol->descripcion}}</td>
				<td>
					{!!link_to_route('rol.edit', $title = 'Editar', $parameters = $rol->id, $attributes = ['class'=>'btn btn-primary'])!!}
				</td>
			</tbody>
		@endforeach
	</table>
	@endsection