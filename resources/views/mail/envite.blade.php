<h1>Você recebeu um convite de {{$envite->empresa->nome}}</h1>

<h3>Esse convite é para fazer parte da nossa plataforma.</h3>

<p>O convite é válido para o e-mail {{$envite->email}}, por tempo limitado.</p>

<p><a href="{{route('aceitar',['envite_token'=>$envite->token])}}">Clique aqui para completar seu cadastro.</a></p>
<p>Ou copie a url a seguir e abra em seu navegador!</p>
<code>
    {{route('aceitar',['envite_token'=>$envite->token])}}
</code>


