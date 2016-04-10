@extends('layouts.admin')
	@include('alertas.success')
	@section('content')
	<table class="table">
		<thead>
			<th>Nombre</th>
			<th>Apellido</th>
			<th>Club</th>
		</thead>
		@foreach($oansistas as $oansista)
			<tbody>
				<td>{{$oansista->nombre}}</td>
				<td>{{$oansista->apellido}}</td>
				<td>
				@if($oansista->grado < 4)
					Chispas
					@elseif($oansista->grado < 6)
						Llamas
					@else
						Antorchas
				@endif

				</td>
				
				<td>
					{!!link_to_route('oansista.edit', $title = 'Editar', $parameters = $oansista->id, $attributes = ['class'=>'btn btn-primary'])!!}
				</td>
			</tbody>
		@endforeach
	</table>
	@endsection