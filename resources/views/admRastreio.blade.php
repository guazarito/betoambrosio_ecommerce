<!DOCTYPE html>
<html lang="en">

    <head>
        <title>
            Loja Beto Ambrosio
        </title>

        <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
        <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet">
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <script src="{{asset('js/jquery-1.8.3.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>

        <style>

        </style>

        <script>
        </script>

    </head>

    <body>

        <div class="container">    
            
            <h3><b>Cod. Rastreio:</b> {{$codigo}}</h3>
            <br><br>
            
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Data</th>
                    <th scope="col">Local</th>
                    <th scope="col">Evento</th>
                  </tr>
                </thead>
                <tbody>
                 @if (isset($eventos_rastreio))
                 @foreach ($eventos_rastreio as $rastreio)   
                  <tr>
                    <th scope="row">{{$rastreio['data']}}</th>
                    <td>{{$rastreio['local']}}</td>
                    <td>{{$rastreio['evento']}} @if($rastreio['para']) para {{$rastreio['para']}} @endif</td>
                  </tr>
                @endforeach
                @else
                <tr><td>Código inválido ou objeto não encontrado<br> Se o objeto foi postado recentemente, pode ser que demore um tempo para aparecer no sistema.</td></tr>
                @endif
                </tbody>
              </table>
        </div>

    </body>
</html>