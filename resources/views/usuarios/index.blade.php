@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<h3>Consulta de Usuários</h3>
			<p>
				<a href="usuarios/create" class="btn btn-primary" role="button" aria-pressed="true">Novo Usuário</a>
			</p>

			<table id="tabela" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Nome</th>
						<th>E-mail</th>
						<th>CPF</th>
						<th>Data de Nascimento</th>
						<th colspan="1">Visualizar</th>
						<th colspan="1">Edição</th>
						<th colspan="1">Exclusão</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($usuarios as $usuario)
					<tr>
						<td>{{ $usuario->name }}</td>
						<td>{{ $usuario->email }}</td>
						<td>{{ $usuario->cpf }}</td>
						<td>{{ date('d/m/Y', strtotime($usuario->data_nascimento)) }}</td>
						<td><a href="{{ action('UsuariosController@show', $usuario->id) }}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Editar">Visualizar</a></td>
						<td><a href="{{ action('UsuariosController@edit', $usuario->id) }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Editar">Editar</a></td>
						<td><a href="{{ route('usuarios.delete', $usuario->id) }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Excluir">Excluir</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>

    	</div>
    </div>
</div>
@endsection
