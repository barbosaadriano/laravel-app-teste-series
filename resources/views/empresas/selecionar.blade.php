@extends('layout')

@section('cabecalho')
    Seleção de empresas
@endsection

@section('conteudo')
@include('errors',['errors'=>$errors])
@isset($mensagem)
    @include('mensagem',['mensagem'=>$mensagem])
@endisset
    <table class="table">
        <tr>
            <th>Empresa</th>
            <th>ações</th>
        </tr>
        @foreach ($empresas as $emp)
            <tr>
                <td>{{$emp->nome}}</td>
                <td>
                    <a href="{{route('selecionar_empresa',['empresa'=>$emp->id])}}" title="selecionar empresa" class="btn btn-info"><i class="fas fa-check-square"></i></a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
