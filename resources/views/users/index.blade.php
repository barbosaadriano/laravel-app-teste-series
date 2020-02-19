@extends('layout')

@section('cabecalho')
    Usuários
@endsection

@section('conteudo')
@include('errors',['errors'=>$errors])
@isset($mensagem)
    @include('mensagem',['mensagem'=>$mensagem])
@endisset
<a href="{{route('convidar_usuario')}}" class="btn btn-success mb-3">Convidar Usuário</a>
<p>Exibindo {{$users->count()}} registros de {{$users->total()}}</p>
{{$users->links()}}
    <table class="table">
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>ações</th>
        </tr>
        @foreach ($users as $u)
            <tr>
                <td>{{$u->id}}</td>
                <td>{{$u->name}}</td>
                <td>{{$u->email}}</td>
                <td>
                    <a href="{{route('apontamentos',['user_id'=>$u->id])}}" title="ver códigos" class="btn btn-info"><i class="fas fa-barcode"></i></a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
