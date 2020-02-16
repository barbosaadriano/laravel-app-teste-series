@extends('layout')

@section('cabecalho')
    Registrar código
@endsection

@section('conteudo')
@include('errors',['errors'=>$errors])
@isset($mensagem)
    @include('mensagem',['mensagem'=>$mensagem])
@endisset
<span class="badge badge-secondary">Você já registrou {{$user->apontamentos->count()}} códigos</span>
<form id="formcodigo" method="post">
    @csrf
    <div class="row">
        <div class="col col-8">
            <label for="codigo" class="">Código</label>
            <input type="text" autofocus onchange="enviar()" class="form-control" name="codigo" id="codigo">
        </div>
    </div>
    <button id="adicionar" class="btn btn-primary mt-2">Adicionar</button>
</form>
<script>
    function enviar() {
        const formEl = document.getElementById(`formcodigo`);
        formEl.submit();
    }
</script>
@endsection
