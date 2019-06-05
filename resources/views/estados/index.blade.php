@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<h3>Consulta de Estados</h3>

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
					<a href="estados/create" class="btn btn-primary" role="button" aria-pressed="true">Novo Estado</a>
				</p>

				<table id="tabela" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Nome</th>
							<th>UF</th>
							<th colspan="1">Edição</th>
							<th colspan="1">Exclusão</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($estados as $estado)
						<tr>
							<td>{{ $estado->nome }}</td>
							<td>{{ $estado->uf }}</td>
							<td><a href="{{ action('EstadosController@edit', $estado->id) }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Editar">Editar</a></td>
							<td><a href="{{ url('estado', $estado->id) }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Excluir">Excluir</a></td>
						</tr>
						@endforeach
					</tbody>
				</table>

    </div>
</div>
@endsection
