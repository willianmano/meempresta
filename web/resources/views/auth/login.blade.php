@extends('layouts.site')

@section('content')
    <div>
        <div>
            <h1 class="logo-name">ME+</h1>
        </div>
        <p>Bem vindo ao sistema de controle de empréstimos pessoais - MeEmpresta
        </p>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops! </strong>Usuário e/ou senha incorreto(s).
            </div>
        @endif
        <form action="{{ url('/') }}/auth/login" method="POST" role="form" class="m-t">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group has-feedback">
                <input type="text" name="email" id="email" placeholder="Digite seu email" class="form-control">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="senha" id="senha" placeholder="Digite sua senha" class="form-control">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Acessar</button>

            {{--<a href="#"><small>Forgot password?</small></a>--}}
            {{--<p class="text-muted text-center"><small>Do not have an account?</small></p>--}}
            {{--<a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>--}}
        </form>
        <p class="m-t"> <small>MeEmpresta © 2016</small> </p>
    </div>
@stop