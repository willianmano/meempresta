@extends('layouts.simple')

@section('content')

<div class="ibox-title">
        <h3>Listagem de empréstimos</h3>
    </div>
<div class="ibox float-e-margins">
    <div class="ibox-content">

        <a href="emprestimos/create" class="btn btn-info"><i class="fa fa-plus"></i> Cadastrar novo empréstimo</a>

        @if(count($emprestimos))
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Devolução</th>
                    <th>Credor</th>
                    <th>Status</th>
                    <th style="width: 40px;"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($emprestimos as $emprestimo)
                        <tr>
                            <td>{{$emprestimo->id}}</td>
                            <td>{{$emprestimo->titulo}}</td>
                            <td>{{$emprestimo->devolucao}}</td>
                            <td>{{$emprestimo->credor}}</td>
                            <td>
                                @if($emprestimo->status == 'devolvido')
                                    <span class="btn btn-xs btn-success"><i class="fa fa-thumbs-up"></i> Devolvido</span>
                                @else
                                    <span class="btn btn-xs btn-warning"><i class="fa fa-times"></i> Pendente</span>
                                @endif

                            </td>
                            <td>
                                @if($emprestimo->status != 'devolvido')
                                    <form action="{{ url('/') }}/emprestimos/baixa" method="POST">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                        <input type="hidden" name="id" value="{{$emprestimo->id}}" />
                                        <button type="submit" aria-label="Dar baixa" class="btn btn-info btn-xs btn-excluir"><i class="fa fa-download"></i> Dar Baixa</button>
                                    </form>
                                @endif
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

            bootbox.confirm("Você tem certeza que deseja dar baixa nesse registro?", function(result) {
                if(result) {
                    $this.closest('form').submit();
                }
            });

            e.preventDefault();
        });
    </script>
@stop
