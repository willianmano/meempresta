@extends('layouts.simple')

@section('content')

<div class="ibox-title">
        <h3>Listagem de contatos</h3>
    </div>
<div class="ibox float-e-margins">
    <div class="ibox-content">

        <a href="contatos/create" class="btn btn-info"><i class="fa fa-plus"></i> Cadastrar novo contato</a>

        @if(count($contatos))
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome Completo</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th style="width: 40px;"></th>
                    <th style="width: 40px;"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($contatos as $contato)
                        <tr>
                            <td>{{$contato->id}}</td>
                            <td>{{$contato->nome}}</td>
                            <td>{{$contato->cpf}}</td>
                            <td>{{$contato->telefone}}</td>
                            <td>{{$contato->email}}</td>
                            <td>
                                <a href="{{url('/')}}/contatos/edit/{{$contato->id}}" title="Editar contato" class="btn btn-xs btn-warning">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </td>
                            <td>
                                <form action="{{ url('/') }}/contatos/delete" method="POST">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                    <input type="hidden" name="id" value="{{$contato->id}}" />
                                    <button type="submit" aria-label="Excluir unidade contato" class="btn btn-danger btn-xs btn-excluir"><i class="fa fa-remove"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
        @endif
    </div>
</div>
@stop

@section('scripts')
    <script src="{{ asset('/js/plugins/bootbox/bootbox.js') }}"></script>

    <script type="text/javascript">
        $(".btn-excluir").on("click" , function(e){
            $this = $(this);

            bootbox.confirm("Você tem certeza que deseja deletar esse registro?", function(result) {
                if(result) {
                    $this.closest('form').submit();
                }
            });

            e.preventDefault();
        });
    </script>
@stop
