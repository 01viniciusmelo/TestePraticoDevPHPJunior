<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Teste prático - Dev PHP Júnior</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- DataTables -->
    <link href="{{ asset('/DataTables-1.10.18/css/jquery.dataTables.min.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    Teste prático - Dev PHP Júnior
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- DataTables -->
    <script src="{{ asset('/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>

    <script>
        $.noConflict();
            jQuery(document).ready(function($) {
                $('#tabela').DataTable({
                    language: {
                        'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json',
                    },
                    "order": [[ 0, 'asc' ]],
                })
            });
    </script>

    <!-- Estados e Cidades do cadastro de endereços -->
    <script>

        var estados = [];

        function loadEstados(element) {
        if (estados.length > 0) {
            putEstados(element);
            $(element).removeAttr('disabled');
        } else {
            $.ajax({
            url: 'https://api.myjson.com/bins/enzld',
            method: 'get',
            dataType: 'json',
            beforeSend: function() {
                $(element).html('<option>Carregando...</option>');
            }
            }).done(function(response) {
            estados = response.estados;
            putEstados(element);
            $(element).removeAttr('disabled');
            });
        }
        }

        function putEstados(element) {

        var label = $(element).data('label');
        label = label ? label : 'Estado';

        var options = '<option value="">' + label + '</option>';
        for (var i in estados) {
            var estado = estados[i];
            options += '<option value="' + estado.sigla + '">' + estado.nome + '</option>';
        }

        $(element).html(options);
        }

        function loadCidades(element, estado_sigla) {
        if (estados.length > 0) {
            putCidades(element, estado_sigla);
            $(element).removeAttr('disabled');
        } else {
            $.ajax({
            url: theme_url + '/assets/json/estados.json',
            method: 'get',
            dataType: 'json',
            beforeSend: function() {
                $(element).html('<option>Carregando...</option>');
            }
            }).done(function(response) {
            estados = response.estados;
            putCidades(element, estado_sigla);
            $(element).removeAttr('disabled');
            });
        }
        }

        function putCidades(element, estado_sigla) {
        var label = $(element).data('label');
        label = label ? label : 'Cidade';

        var options = '<option value="">' + label + '</option>';
        for (var i in estados) {
            var estado = estados[i];
            if (estado.sigla != estado_sigla)
            continue;
            for (var j in estado.cidades) {
            var cidade = estado.cidades[j];
            options += '<option value="' + cidade + '">' + cidade + '</option>';
            }
        }
        $(element).html(options);
        }

        document.addEventListener('DOMContentLoaded', function() {
            loadEstados('#estado_id');
            $(document).on('change', '#estado_id', function(e) {
                var target = $(this).data('target');
                if (target) {
                loadCidades(target, $(this).val());
                }
            });
        }, false);

	</script>

</body>
</html>
