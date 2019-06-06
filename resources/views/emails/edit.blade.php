@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<h3>Editar E-mail</h3>

			{!! Form::model($email, ['route' => ['emails.update', $email->id], 'class' => 'form', 'method' => 'post']) !!} {!! Form::hidden('_method', 'PATCH') !!}
				<div class="row">
					<div class="form-group col-md-4 input-group-lg">{!! Form::label('user_id', 'Usuário') !!} {!! Form::select('user_id', $lista_usuarios,
						null, ['class' => 'form-control']) !!}</div>
					<div class="form-group col-md-4 input-group-lg">{!! Form::label('email', 'E-mail') !!} {!! Form::email('email', null, ['class' =>
						'form-control', 'maxlength' => 191, 'autocomplete' => 'off']) !!}</div>
				</div>

				<div class="row">
					<div class="form-group col-md-4"></div>
					<div class="form-group col-md-4">{!! Form::submit('Salvar Alteração', ['class' => 'btn btn-success btn-lg', 'style' => 'margin-left: 38px']) !!}</div>
				</div>
			{!! Form::close() !!}

		</div>
	</div>
</div>
@endsection
