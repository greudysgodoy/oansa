@extends('layouts.admin')
	@include('alertas.success')
	@section('content')
	<table class="table">
		<thead>
			<th>Nombre</th>
			<th>Descripción</th>
		</thead>
		@foreach($areas as $area)
			<tbody>
				<td>{{$area->nombre}}</td>
				<td>{{$area->descripcion}}</td>
								
				<td>
					{!!link_to_route('area.edit', $title = 'Editar', $parameters = $area->id, $attributes = ['class'=>'btn btn-primary'])!!}
				</td>
			</tbody>
		@endforeach
	</table>
	@endsection