@extends('layouts.admin')
	@include('alertas.success')
	@section('content')
	

	{!!Form::open(['url'=>'manual/progreso', 'method'=>'GET'],['class'=>'form-horizontal'])!!}
		<h3>Seleccione un manual</h3>
		
		<div class="form-group">
			<table class="table">
				<thead>
					@foreach($oansistas->get() as $oansista)
						<th> {{$oansista->fullname}}</th>
						<th>@if($oansista->grado < 4)
							Chispas
							@elseif($oansista->grado < 6)
								Llamas
							@else
								Antorchas
						@endif</th>
					@endforeach
				</thead>
				
			</table>
		<div class="form-group">
			{!! Form::label('manual_id','Manual:') !!}
			{!! Form::select('manual_id',$manuales) !!}
		</div>
			{!! Form::hidden('oansista_id', $oansista->id) !!}
	{!!Form::submit('Aceptar',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
	
	@endsection