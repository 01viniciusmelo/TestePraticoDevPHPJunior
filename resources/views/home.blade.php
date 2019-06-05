@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Consultas</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>
                        <a href="estados" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Consulta de Estados</a>
                    </p>
                    <p>
                        <a href="cidades" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Consulta de Cidades</a>
                    </p>
                    <p>
                        <a href="telefones" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Consulta de Telefones</a>
                    </p>
                    <p>
                        <a href="emails" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Consulta de E-mails</a>
                    </p>
                    <p>
                        <a href="enderecos" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Consulta de Endereços</a>
                    </p>
                    <p>
                        <a href="usuarios" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Consulta de Usuários</a>
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
