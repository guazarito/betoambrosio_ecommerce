<!DOCTYPE html>
<html lang="en">
    
    <head>
                <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
        <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet">
        <link href="{{asset('css/style.default.css')}}" rel="stylesheet" id="theme-stylesheet">
        <style>
            body{
                background-color: #fff;
            }
        </style>    
    </head>

    <body>
        <div class="container meus_pedidos">
                <h1>Dados usuário:</h1>
                <br>
        @if (isset($eu))

                        <p><b>Nome:</b> {{$eu->name}}</p>
                        <p><b>email:</b> {{$eu->email}}</p>
                        <p><b>Celular:</b> {{$eu->celular}}</p>
                        <br>
                        <h2>Endereço:</h2>
                        <p><b>CEP:</b> {{$eu->cep}}</p>
                        <p><b>Cidade:</b> {{$eu->cidade}}</p>
                        <p><b>Estado:</b>  {{$eu->estado}}</p>
                        <p><b>Bairro:</b> {{$eu->bairro}}</p>
                        <p><b>Endereço:</b> {{$eu->rua}}</p>
                        <p><b>Numero:</b> {{$eu->numero}}</p>
                        @if (isset($eu->complemento))
                        <p><b>Complemento:</b> {{$eu->complemento}}</p>
                        @else
                        <p><b>Complemento:</b> -</p>           
                        @endif

        @else

        <p>Nenhum dado encontrado.</p>
        <style>
          footer{
          position: absolute;
          bottom: 0;
          width: 100%;
          }
        </style>
        @endif
        </div><!--container-->
    </body>
</html>