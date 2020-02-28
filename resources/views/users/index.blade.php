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
                    <a href="{{route('apontamentos',['user_id'=>$u->id])}}"
                        title="ver códigos"
                        class="btn btn-info"><i class="fas fa-barcode"></i></a>

                    <a href="{{route('users.edit',['usuario'=>$u->id])}}"
                            title="Editar usuário"
                            class="btn btn-info ml-3"><i class="fas fa-edit"></i></a>

                    <a href="{{route('users.block',['usuario'=>$u->id])}}"
                            title="Bloquear usuário"
                            class="btn btn-warning ml-3"><i class="fas fa-lock"></i></a>

                    <a href="{{route('users.rem',['usuario'=>$u->id])}}"
                            title="Remover usuário"
                            class="btn btn-danger ml-3"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
