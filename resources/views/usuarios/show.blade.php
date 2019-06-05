@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<h2><strong>Visualizando dados do usuário: {{ $usuario->name }}</strong></h2>

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

					<div class="row">
						<div class="form-group col-md-8 input-group-lg">
							<h4>
								<p>
									Código Interno: {{ $usuario->id }}
								</p>
								<p>
									E-mail: {{ $usuario->email }}
								</p>
								<p>
									CPF: {{ $usuario->cpf }}
								</p>
								<p>
									Data de Nascimento: {{ date('d/m/Y', strtotime($usuario->data_nascimento)) }}
								</p>
								<p>
									Criado em: {{ date('d/m/Y H:i:s', strtotime($usuario->created_at)) }}
								</p>
								<p>
									Atualizado em: {{ date('d/m/Y H:i:s', strtotime($usuario->updated_at)) }}
								</p>
							</h4>
						</div>
					</div>

	</div>
	</div>
	</div>
@endsection
