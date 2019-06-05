@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<h3>Editar Endereço</h3>

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

					{!! Form::model($endereco, ['route' => ['enderecos.update', $endereco->id], 'class' => 'form', 'method' => 'post']) !!} {!!
					Form::hidden('_method', 'PATCH') !!}

					<div class="row">
						<div class="form-group col-md-4 input-group-lg">{!! Form::label('user_id', 'Usuário') !!} {!! Form::select('user_id', $lista_usuarios,
							null, ['class' => 'form-control']) !!}</div>

						<div class="form-group col-md-4 input-group-lg">
							{!! Form::label('estado_id', 'Estados') !!}
							<select name="estado_id" id="estado_id" disabled data-target="#cidade" class="form-control">
									<option value="">Estado</option>
							</select>
						</div>

						<div class="form-group col-md-4 input-group-lg">
							{!! Form::label('cidade_id', 'Cidades') !!}
							<select name="cidade" id="cidade" disabled class="form-control">
									<option value="">Cidade</option>
							</select>
						</div>
					</div>

					<div class="row">
						<div class="form-group col-md-4 input-group-lg">{!! Form::label('tipo', 'Tipo Endereço') !!} {!! Form::select('tipo', ['Trabalho' => 'Trabalho','Casa'=>'Casa','Outro'=>'Outro'], null, ['class' =>
							'form-control', 'maxlength' => 20, 'autocomplete' => 'off', 'placeholder'=>'Selecione o tipo de endereço']) !!}</div>
						<div class="form-group col-md-8 input-group-lg">{!! Form::label('endereco', 'Endereço') !!} {!! Form::text('endereco', null, ['class' =>
							'form-control', 'maxlength' => 100, 'autocomplete' => 'off']) !!}</div>
					</div>

					<div class="row">
						<div class="form-group col-md-8 input-group-lg">{!! Form::label('complemento', 'Complemento') !!} {!! Form::text('complemento', null, ['class' =>
							'form-control', 'maxlength' => 100, 'autocomplete' => 'off']) !!}</div>
						<div class="form-group col-md-4 input-group-lg">{!! Form::label('bairro', 'Bairro') !!} {!! Form::text('bairro', null, ['class' =>
							'form-control', 'maxlength' => 100, 'autocomplete' => 'off']) !!}</div>
					</div>

					<div class="row">
						<div class="form-group col-md-4"></div>
						<div class="form-group col-md-4">{!! Form::submit('Salvar Alteração', ['class' => 'btn btn-success btn-lg', 'style' => 'margin-left:
							38px']) !!}</div>
						<!-- /.form-group /.col-md-4 -->
					</div>
					<!-- /.row -->

					{!! Form::close() !!}
	</div>
	</div>
	</div>
@endsection
