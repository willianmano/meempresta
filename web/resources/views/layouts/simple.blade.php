<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Me Empresta</title>

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet"/>

    @section('stylesheets')
    @show
</head>
<body class="skin-1 top-navigation">
@section('lockscreen')
    <div id="loading-overlay" class="loading"></div>
    <div id="loading-message" class="loading">
        <p>Carregando...</p>
        <div class="three-quarters"></div>
    </div>
@show
<div id="wrapper">
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a href="#" class="navbar-brand">Me Empresta</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Cadastros <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="{{ url('/') }}/contatos">Contatos</a></li>
                            <li><a href="{{ url('/') }}/emprestimos">Empréstimos</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Relatórios <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="{{ url('/') }}/devedores">Devedores</a></li>
                        </ul>
                    </li>                </ul>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Você está logado como: <a href="{{url('/')}}/profile">Administrador</a></span>
                    </li>
                    <li>
                        <a href="{{ url('auth/logout') }}">
                            <i class="fa fa-sign-out"></i> Sair
                        </a>
                    </li>
                </ul>
            </nav><!-- /.navbar -->
        </div>

        <div class="wrapper wrapper-content">
            @include('flash::message')
            @yield('content')
        </div><!-- /.wrapper-content -->

    </div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->

<script src="{{ asset('/js/jquery.js') }}"></script>
<script src="{{ asset('/js/bootstrap.js') }}"></script>

@yield('scripts')

</body>
</html>
