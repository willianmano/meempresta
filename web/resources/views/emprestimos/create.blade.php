@extends('layouts.simple')

@section('content')
    <div class="ibox-title">
        <h3>Formulário de cadastro de empréstimos</h3>
    </div>

    <div class="ibox-content">
        <form action="{{ url('/') }}/emprestimos/create" method="POST">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="row">
                <div class="form-group col-md-3 @if ($errors->has('tipo_emprestimo_id')) has-error @endif">
                    <label for="tipo_emprestimo_id">Tipo de empréstimo</label>
                    <div class="input-group col-lg-12">
                        <select name="tipo_emprestimo_id" id="tipo_emprestimo_id" class="form-control">
                            @if(count($tiposEmprestimos))
                                <option value=""></option>
                                @foreach($tiposEmprestimos as $tipo)
                                    <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('tipo_emprestimo_id')) <p class="help-block">{{ $errors->first('tipo_emprestimo_id') }}</p> @endif
                    </div>
                </div>

                <div class="form-group col-md-9 @if ($errors->has('contato_id')) has-error @endif">
                    <label for="contato_id">Nome do contato</label>
                    <div class="input-group col-lg-12">
                        <select name="contato_id" id="contato_id" class="form-control">
                            @if(count($contatos))
                                <option value=""></option>
                                @foreach($contatos as $contato)
                                    <option value="{{$contato->id}}">{{$contato->nome}}</option>
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('contato_id')) <p class="help-block">{{ $errors->first('contato_id') }}</p> @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-8 @if ($errors->has('titulo')) has-error @endif">
                    <label for="titulo">Título</label>
                    <div class="input-group col-lg-12">
                        <input type="text" name="titulo" id="titulo" class="form-control">
                        @if ($errors->has('titulo')) <p class="help-block">{{ $errors->first('titulo') }}</p> @endif
                    </div>
                </div>

                <div class="form-group col-md-4 @if ($errors->has('devolucao')) has-error @endif">
                    <label for="devolucao">Data da devolução</label>
                    <div class="input-group col-lg-12">
                        <input type="date" name="devolucao" id="devolucao" class="form-control">
                        @if ($errors->has('devolucao')) <p class="help-block">{{ $errors->first('devolucao') }}</p> @endif
                    </div>
                </div>
            </div>

            <div class="form-group @if ($errors->has('observacao')) has-error @endif">
                <label for="observacao">Observação</label>
                <div class="input-group col-lg-12">
                    <textarea name="observacao" id="observacao" rows="4" class="form-control"></textarea>
                    @if ($errors->has('observacao')) <p class="help-block">{{ $errors->first('observacao') }}</p> @endif
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
