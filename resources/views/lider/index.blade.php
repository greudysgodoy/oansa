@extends('layouts.admin')
	@include('alertas.success')
	@section('content')
	<table class="table">
		<thead>
			<th>Nombre</th>
			<th>Apellido</th>
			<th>Área</th>
			<th>Teléfono</th>
			<th>Líder de Gdc</th>
			<th>Teléfono de líder Gdc</th>
			<th>Rol</th>
		</thead>
		@foreach($lideres as $lider)
			<tbody>
				<td>{{ $lider->nombre }}</td>
				<td>{{ $lider->apellido }}</td>
				<td>{{ $lider->nombreArea }}</td>
				<td>{{ $lider->telefono }}</td>
				<td>{{ $lider->liderGdc }}</td>
				<td>{{ $lider->telefonoLiderGdc }}</td>
				<td>{{ $lider->nombreRol }}</td>

				<td>
					{!!link_to_route('lider.edit', $title = 'Editar', $parameters = $lider->cedula, $attributes = ['class'=>'btn btn-primary'])!!}
				</td>
			</tbody>
		@endforeach
	</table>
	@endsection