@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<h3>Novo Telefone</h3>

			{!! Form::open(['url' => 'telefones', 'method' => 'post']) !!}
				<div class="row">
					<div class="form-group col-md-4 input-group-lg">{!! Form::label('user_id', 'Usuário') !!} {!! Form::select('user_id', $lista_usuarios,
						null, ['class' => 'form-control']) !!}</div>
					<div class="form-group col-md-4 input-group-lg">{!! Form::label('tipo', 'Tipo Telefone') !!} {!! Form::select('tipo', ['Comercial' => 'Comercial','Residencial'=>'Residencial','Celular'=>'Celular','Recados'=>'Recados'], null, ['class' =>
						'form-control', 'maxlength' => 20, 'autocomplete' => 'off', 'placeholder'=>'Selecione o tipo de telefone']) !!}</div>
				</div>
				<div class="row">
					<div class="form-group col-md-4 input-group-lg">{!! Form::label('ddd', 'DDD') !!} {!! Form::text('ddd', null, ['class' =>
						'form-control', 'maxlength' => 2, 'autocomplete' => 'off']) !!}</div>
					<div class="form-group col-md-4 input-group-lg">{!! Form::label('telefone', 'Telefone') !!} {!! Form::text('telefone', null, ['class' =>
						'form-control', 'maxlength' => 10, 'autocomplete' => 'off']) !!}</div>
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
