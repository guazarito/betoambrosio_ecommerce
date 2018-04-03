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
            .cod_rastreamento{
                display: none;
            }
        </style>

        <script>
            $(document).ready(function(){
                $("#selEnvio").change(function () {
                        $( "select option:selected" ).each(function() {
                            if($( this ).val() == 'postado'){
                                $('.cod_rastreamento').css('display','block');
                            }else{
                                $('#rastreio').val('');
                                $('.cod_rastreamento').css('display','none');
                            }
                          });
                });
            });	
        </script>

    </head>

    <body>

        <div class="container">

            <div class="row">

                <form class="form-horizontal" method="POST" action="{{route('adm_salva_detalhes_pedido',$pedido->id)}}">
                    {{ csrf_field() }}
                    <h1>Pedido #{{$pedido->reference}}</h1>
                    <p><b>Cod. transação PagSeguro:</b><br>{{$pedido->pagseguro_transaction_code}}</p>
                    <br><br>
                    <h1>Envio:</h1>
                    <div class="form-group">
                        <label for="rastreio" class="col-md-4 control-label">Status de envio:</label>

                        <div class="col-md-6">
                            <select name="selEnvio" id="selEnvio">
                                <?php
                                    if(!isset($pedido->status_envio) || $pedido->status_envio==1){
                                        $select_pendente = "selected='selected'";
                                        $select_postado = "";
                                        $display_rastreio = "none";
                                    }else{
                                        $select_pendente = "";
                                        $select_postado = "selected='selected'";
                                        $display_rastreio = "block";
                                    }
                                ?>
                                <option value="envio_pendente" {{$select_pendente}}>Envio pendente</option>
                                <option value="postado" {{$select_postado}}>Postado</option>
                            </select>
                        </div>

                    </div> 
                    <div class="form-group cod_rastreamento" style="display: {{$display_rastreio}};">
                        <label for="rastreio" class="col-md-4 control-label">Código de rastreamento:</label>

                        <div class="col-md-6">
                            <input id="rastreio" type="text" class="form-control" value="{{$pedido->rastreio}}" name="rastreio" maxlength="13" >
                        </div>
                    </div>   
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-warning">
                                Salvar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </body>
</html>