@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<h3>Editar Estado</h3>

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

					{!! Form::model($estado, ['route' => ['estados.update', $estado->id], 'class' => 'form', 'method' => 'post']) !!} {!!
					Form::hidden('_method', 'PATCH') !!}

					<div class="row">
						<div class="form-group col-md-4 input-group-lg">{!! Form::label('nome', 'Nome') !!} {!! Form::text('nome', null, ['class' =>
							'form-control', 'maxlength' => 100, 'autocomplete' => 'off']) !!}</div>
						<div class="form-group col-md-4 input-group-lg">{!! Form::label('uf', 'UF') !!} {!! Form::text('uf', null, ['class' =>
							'form-control', 'maxlength' => 2, 'autocomplete' => 'off']) !!}</div>
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
