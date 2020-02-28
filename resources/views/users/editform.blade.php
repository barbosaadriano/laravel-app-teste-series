@extends('layout')

@section('cabecalho')
    Alterar usuário
@endsection

@section('conteudo')
<form method="post" action="{{route('users.update',['usuario'=>$usuario->id])}}">
    @csrf
    @method('put')
    <div class="form-group">
        <label for="name">Nome</label>
        <input type="text" name="name" id="name" value="{{$usuario->name}}" required class="form-control">
    </div>

    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" name="email" value="{{$usuario->email}}" id="email" required class="form-control">
    </div>

    <div class="form-group">
        <label for="name">Sua Empresa</label>
    <input type="text" readonly value="{{$usuario->empresa->nome}}" class="form-control">
    </div>

    <div class="form-group">
        <label for="password">Nova Senha</label>
        <input type="password" name="password" id="password"  min="1" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary mt-3">
        Salvar
    </button>
    <a class="btn btn-warning mt-3" href="{{route('listar_usuarios')}}">
        <i class="fas fa-arrow-left"></i> &nbsp; Voltar
    </a>
</form>
@endsection
