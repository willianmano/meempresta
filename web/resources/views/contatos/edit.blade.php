@extends('layouts.simple')

@section('content')
    <div class="ibox-title">
        <h3>Formulário de cadastro de contatos</h3>
    </div>

    <div class="ibox-content">
        <form action="{{ url('/') }}/contatos/edit" method="POST">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="id" value="{{$contato->id}}">
            <div class="row">
                <div class="form-group col-md-3 @if ($errors->has('cpf')) has-error @endif">
                    <label for="cpf">CPF do contato</label>
                    <div class="input-group col-lg-12">
                        <input type="text" name="cpf" class="form-control" value="{{$contato->cpf}}">
                        @if ($errors->has('cpf')) <p class="help-block">{{ $errors->first('cpf') }}</p> @endif
                    </div>
                </div>

                <div class="form-group col-md-9 @if ($errors->has('nome')) has-error @endif">
                    <label for="nome">Nome do contato</label>
                    <div class="input-group col-lg-12">
                        <input type="text" name="nome" class="form-control" value="{{$contato->nome}}">
                        @if ($errors->has('nome')) <p class="help-block">{{ $errors->first('nome') }}</p> @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3 @if ($errors->has('sexo')) has-error @endif">
                    <label for="sexo">Sexo do contato</label>
                    <div class="input-group col-lg-12">
                        <select class="form-control" name="sexo">
                            <option value="m" @if($contato->sexo == 'm') selected="selected" @endif>Masculino</option>
                            <option value="f" @if($contato->sexo == 'f') selected="selected" @endif>Feminino</option>
                        </select>
                        @if ($errors->has('sexo')) <p class="help-block">{{ $errors->first('sexo') }}</p> @endif
                    </div>
                </div>

                <div class="form-group col-md-3 @if ($errors->has('telefone')) has-error @endif">
                    <label for="telefone">Telefone do contato</label>
                    <div class="input-group col-lg-12">
                        <input type="text" name="telefone" class="form-control" value="{{$contato->telefone}}">
                        @if ($errors->has('telefone')) <p class="help-block">{{ $errors->first('telefone') }}</p> @endif
                    </div>
                </div>

                <div class="form-group col-md-6 @if ($errors->has('email')) has-error @endif">
                    <label for="email">Email do contato</label>
                    <div class="input-group col-lg-12">
                        <input type="text" name="email" class="form-control" value="{{$contato->email}}">
                        @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <input type="submit" value="Salvar Dados" class="btn btn-primary">
                </div>
        </div>
        </form>
    </div>
@stop
