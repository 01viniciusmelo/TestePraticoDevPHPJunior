@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<h3>Nova Cidade</h3>

		@if (count($errors) > 0)
		<div class="alert alert-warning">
			<strong>Ops!</strong> Revise o(s) aviso(s) abaixo:<br>
			<ul>
				@foreach ($errors->all() as $message)
				<li>{{ $message }}</li> @endforeach
			</ul>
		</div>
		@endif @if(\Session::has('success'))
		<div class="alert alert-success">
			<p>{{\Session::get('success')}}</p>
		</div>
		@endif

					{!! Form::open(['url' => 'cidades', 'method' => 'post']) !!}

					<div class="row">
						<div class="form-group col-md-4 input-group-lg">{!! Form::label('nome', 'Nome') !!} {!! Form::text('nome', null, ['class' =>
							'form-control', 'maxlength' => 100, 'autocomplete' => 'off']) !!}</div>
						<div class="form-group col-md-4 input-group-lg">{!! Form::label('estado_id', 'Estado') !!} {!! Form::select('estado_id', $lista_estados,
							null, ['class' => 'form-control']) !!}</div>
					</div>


					<div class="row">
						<div class="form-group col-md-4"></div>
						<div class="form-group col-md-4">{!! Form::submit('Salvar', ['class' => 'btn btn-success btn-lg', 'style' => 'margin-left: 38px']) !!}</div>
					</div>
					{!! Form::close() !!}
	</div>
	</div>
	</div>
@endsection
