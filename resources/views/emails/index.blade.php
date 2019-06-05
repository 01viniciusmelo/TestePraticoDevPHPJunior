@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<h3>Consulta de E-mails</h3>

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
						<h4>{{\Session::get('success')}}</h4>
					</div>
					@endif

				<p>
					<a href="emails/create" class="btn btn-primary" role="button" aria-pressed="true">Novo E-mail</a>
				</p>

				<table id="tabela" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Usuário</th>
							<th>E-mail</th>
							<th colspan="1">Edição</th>
							<th colspan="1">Exclusão</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($emails as $email)
						<tr>
							<td>{{ $email->nome_usuario }}</td>
							<td>{{ $email->email }}</td>
							<td><a href="{{ action('EmailsController@edit', $email->id) }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Editar">Editar</a></td>
							<td><a href="{{ url('email', $email->id) }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Excluir">Excluir</a></td>
						</tr>
						@endforeach
					</tbody>
				</table>

    </div>
</div>
@endsection
