@extends('layout')

@section('cabecalho')
    Início
@endsection

@section('conteudo')
<div class="container">
    @isset($mensagem)
        @include('mensagem',['mensagem'=>$mensagem])
    @endisset
</div>
@endsection
