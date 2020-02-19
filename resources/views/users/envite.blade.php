@extends('layout')

@section('cabecalho')
    Convidar usuário
@endsection

@section('conteudo')
@include('errors',['errors'=>$errors])
@isset($mensagem)
    @include('mensagem',['mensagem'=>$mensagem])
@endisset
<form method="post">
    @csrf

    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" required class="form-control">
    </div>

    <button type="submit" class="btn btn-primary mt-3">
        Enviar convite
    </button>
</form>

@endsection
