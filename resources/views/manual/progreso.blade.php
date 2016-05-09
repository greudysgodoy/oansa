@extends('layouts.admin')

	@section('content')

		<h4>Manual {{ $manual[0]->nombre }}</h4>
		<br>
		<?php $i = 0; ?>
		@foreach($estaciones as $estacion)
			<strong>{{ $estacion->nombre }}</strong>
			<br>
				<?php $j = 1; ?>
			<table class="table">
				<tbody>
				<td>
					<?php $j =1; ?>
					@foreach($secciones[$i] as $seccion)
						@if($seccion['fechaAprobada']!='0000-00-00 00:00:00')
							{!! Form::button($j,['class'=>'btn btn-primary']) !!}
					
						
						
						@else
							{!! Form::hidden('seccion_id', $seccion['id'], array('id' => 'seccion_id')) !!}
							
							{!! link_to('manual/aprobada/'.$manual[0]->id.'/'.$manual[0]->oansista_id.'/'.$seccion['id'], $title =$j, $atributes = ['id'=>'aprobar', 'class'=>'btn btn-default'], $secure = null) !!}

						@endif
			  				<?php $j ++; ?>
				@endforeach
				</td>
					</tbody>
				<?php $i ++; ?>
						
			</table>
		@endforeach
	@endsection

