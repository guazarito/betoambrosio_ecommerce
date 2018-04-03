@extends('layout')

@section('content')

<style>
    body{
        background-color: #fff;
    }
</style>


<div class="container meus_pedidos">
	<h1 id="meuspedidos_title">Meus Pedidos</h1>
	<br>
@if (sizeof($orders)>0)
	<?php $i=0; ?>
	<table class="table" style="border-bottom:2px solid #dddddd;">
	  <thead>
	    <tr>
	      <th>#</th>
	      <th>Descrição</th>
	      <th style="text-align: center;">Qtde</th>
	      <th style="text-align: center;">Valor Unitário</th>
	      <th style="text-align: center;">Taxa PagSeguro</th>
	      <th style="text-align: center;">Frete</th>
              <th style="text-align: center;">Total Pedido</th>
	      <th style="text-align: center;">Data</th>
	      <th style="text-align: center;">Status</th>
	      <th style="text-align: center;">Status Envio</th>
	      <th style="text-align: center;">Forma Pagto</th>
	      <th></th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach($orders as $order)
	  	<?php $i++; 
                $status_envio="-";
                
		switch ($order->status) {
	    case 1:
	        $status_nome = "Aguardando pagamento";
	        break;
	    case 2:
	        $status_nome = "Em análise";
	        break;
	    case 3:
	        $status_nome = "Pago";
	        break;
	    case 4:
	        $status_nome = "Disponível";
	        break;
	    case 5:
	        $status_nome = "Em disputa";
	        break;
	    case 6:
	        $status_nome = "Devolvida";
	        break;
	    case 7:
	        $status_nome = "Cancelada";
	        break;
	    case 8:
	        $status_nome = "Debitado";
	        break;
	    case 9:
	        $status_nome = "Retenção temporária";
	        break;
	    }
            
            switch ($order->status_envio) {
 	    case 1:
	        $status_envio = "Pendente";
	        break;
	    case 2:
	        $status_envio = "Postado";
	        break;               
            }

	  	?>
	    <tr>
	      <th scope="row">{{$i}}</th>
	      <td><h3 style="display: inline;">Livro Fé Latina</h3></td>
	      <td style="text-align: center;">x{{$order->qtde}}</td>
              <td style="text-align: center;">R$ {{str_replace(",",".",number_format($order->preco_livro/$order->qtde,2))}}</td>
	      <td style="text-align: center;">R$ {{str_replace(",",".",number_format($order->taxa_pagseguro,2))}}</td>
	      <td style="text-align: center;">R$ {{str_replace(",",".",number_format($order->frete,2))}}</td>
	      <td style="text-align: center;">R$ {{str_replace(",",".",number_format($order->preco_total,2))}}</td>
	      <td style="text-align: center;">{{date_format($order->created_at,"d/m/Y")}}</td>
	      <td style="text-align: center;" id="status_nome">{{$status_nome}}</td>
	      <td style="text-align: center;" >
                  {{$status_envio}}
                  @if ($order->rastreio)
                  <br><a data-fancybox data-type="iframe" data-src="{{route('adm_rastreio',$order->rastreio)}}" href="javascript;">{{$order->rastreio}}</a>
                  @endif
              </td>
              @if ($order->forma_pagto == "boleto")
              <td style="text-align: center;"><a data-fancybox data-type="iframe" data-src="{{$order->url_boleto}}" href="javascript;" title="Ver boleto"><img src="{{asset('/img/boleto.png')}}" style="width: 55px;"></a></td>
              @else
              <td style="text-align: center;">Cartão de crédito</td>
              @endif
	    </tr>
	    @endforeach
	  </tbody>
	</table>

@else
<p>Nenhum pedido encontrado.</p>
<style>
  footer{
  position: absolute;
  bottom: 0;
  width: 100%;
  }
</style>

@endif
</div><!--container-->

@if (sizeof($orders)==1)
<style>
 footer{
  position: absolute;
  bottom: 0;
  width: 100%;
  }
</style>
@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
		 <script>			
                    $("[data-fancybox]").fancybox({
                                iframe : {

                                            preload : true,
                                            css : {
                                                    width: '90%',
                                                    height: '90%'
                                            },
                                            attr : {
                                                    scrolling : 'auto'
                                            }

                                    }
                    });	
                  </script>

@endsection