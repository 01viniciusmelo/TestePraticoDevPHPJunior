@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<h3>Consulta de Endereços</h3>
			<p>
				<a href="enderecos/create" class="btn btn-primary" role="button" aria-pressed="true">Novo Endereço</a>
			</p>

			<table id="tabela" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Usuário</th>
						<th>Cidade</th>
						<th>Estado</th>
						<th>Tipo</th>
						<th>Endereço</th>
						<th>Complemento</th>
						<th>Bairro</th>
						<th colspan="1">Edição</th>
						<th colspan="1">Exclusão</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($enderecos as $endereco)
					<tr>
						<td>{{ $endereco->nome_usuario }}</td>
						<td>{{ $endereco->nome_cidade }}</td>
						<td>{{ $endereco->nome_estado }}</td>
						<td>{{ $endereco->tipo }}</td>
						<td>{{ $endereco->endereco }}</td>
						<td>{{ $endereco->complemento }}</td>
						<td>{{ $endereco->bairro }}</td>
						<td><a href="{{ action('EnderecosController@edit', $endereco->id) }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Editar">Editar</a></td>
						<td><a href="{{ url('endereco', $endereco->id) }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Excluir">Excluir</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>

    	</div>
    </div>
</div>
@endsection
