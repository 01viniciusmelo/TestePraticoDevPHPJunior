@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<h3>Novo Estado</h3>

			{!! Form::open(['url' => 'estados', 'method' => 'post']) !!}
				<div class="row">
					<div class="form-group col-md-4 input-group-lg">{!! Form::label('nome', 'Nome') !!} {!! Form::text('nome', null, ['class' =>
						'form-control', 'maxlength' => 100, 'autocomplete' => 'off']) !!}</div>
					<div class="form-group col-md-4 input-group-lg">{!! Form::label('uf', 'UF') !!} {!! Form::text('uf', null, ['class' =>
						'form-control', 'maxlength' => 2, 'autocomplete' => 'off']) !!}</div>
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
