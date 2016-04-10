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
		</thead>
		@foreach($lideres as $lider)
			<tbody>
				<td>{{$->nombre}}</td>
				<td>{{$lider->apellido}}</td>
				<td>
				@if($lider->grado < 4)
					Chispas
					@elseif($lideroansista->grado < 6)
						Llamas
					@else
						Antorchas
				@endif

				</td>
				
				<td>
					{!!link_to_route('lideroansista.edit', $title = 'Editar', $parameters = $lideroansista->id, $attributes = ['class'=>'btn btn-primary'])!!}
				</td>
			</tbody>
		@endforeach
	</table>
	@endsection