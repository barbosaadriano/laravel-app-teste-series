@extends('layout')

@section('cabecalho')
    Códigos registrados
@endsection

@section('conteudo')
@include('errors',['errors'=>$errors])
@isset($mensagem)
    @include('mensagem',['mensagem'=>$mensagem])
@endisset
@isset($nome)
<h3>Apontamentos de {{$nome}}</h3>
@endisset
<p>Exibindo {{$apontamentos->count()}} registros de {{$apontamentos->total()}}</p>
{{$apontamentos->links()}}
    <table class="table">
        <tr>
            <th>Código</th>
        </tr>
        @foreach ($apontamentos as $ap)
            <tr>
                <td>{{$ap->codigo}}</td>
            </tr>
        @endforeach
    </table>
@endsection
