@extends('layouts.simple')

@section('content')

<div class="ibox-title">
        <h3>Listagem de devedores</h3>
    </div>
<div class="ibox float-e-margins">
    <div class="ibox-content">

        @if(count($devedores))
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($devedores as $devedor)
                        <tr>
                            <td>{{$devedor->id}}</td>
                            <td>{{$devedor->nome}}</td>
                            <td>{{$devedor->telefone}}</td>
                            <td>{{$devedor->email}}</td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
        @endif
    </div>
</div>
@stop
