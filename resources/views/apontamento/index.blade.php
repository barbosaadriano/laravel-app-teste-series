@extends('layout')

@section('cabecalho')
    Códigos registrados @isset($nome) por {{$nome}} @endisset
@endsection

@section('conteudo')
@include('errors',['errors'=>$errors])
@isset($mensagem)
    @include('mensagem',['mensagem'=>$mensagem])
@endisset
@isset($nome)
<h3>Apontamentos</h3>
@endisset
<p>Exibindo os últimos {{$apontamentos->count()}} registros
    de um total de {{$apontamentos->total()}}</p>
    <a href="" class="btn btn-success">Exportar Todos</a>
    <a href="" class="btn btn-success btn-lg mb-2">Exportar registros ainda não exportados</a>
    <table class="table">
        <tr>
            <th>Código</th>
            <th>Momento</th>
            <th>Exportado?</th>
        </tr>
        @foreach ($apontamentos as $ap)
            <tr>
                <td>{{$ap->codigo}}</td>
                <td>{{$ap->created_at}}</td>
                <td>{{$ap->exportado}}</td>
            </tr>
        @endforeach
    </table>
@endsection
