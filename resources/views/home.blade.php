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
                        <div class="row">
                            <div class="col-md-4">
                                <a href="estados" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Consulta de Estados</a>
                            </div>
                            <div class="col-md-4">
                                <a href="cidades" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Consulta de Cidades</a>
                            </div>
                            <div class="col-md-4">
                                <a href="telefones" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Consulta de Telefones</a>
                            </div>
                        </div>
                    </p>

                    <p>
                        <div class="row">
                            <div class="col-md-4">
                                <a href="emails" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Consulta de E-mails</a>
                            </div>
                            <div class="col-md-4">
                                <a href="enderecos" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Consulta de Endereços</a>
                            </div>
                            <div class="col-md-4">
                                <a href="usuarios" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Consulta de Usuários</a>
                            </div>
                        </div>
                    </p>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
