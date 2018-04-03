@extends('layout')

@section('content')

<style>
    body{
        background-color: #fff;
    }
    
    .table tr:hover{
        cursor: pointer;
        font-weight: bold;
    }
    
    #tbResumo,#tbResumo th{
        text-align: center;
    }
</style>



<div class="container-fluid meus_pedidos">
	<h1 id="meuspedidos_title">Pedidos</h1>
	<br>
@if (sizeof($pedidos)>0)
         
<h3 style="display:inline;">Resumo </h3><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
<table id="tbResumo" class="table" >
    <thead>
    <th></th>
        <th>Pedidos pagos</th>
        <th>Pedidos aguardando pagamento</th>
        <th>Pedidos cancelados</th>
        <th>Total</th>
    </thead>
    <tbody>
        <tr>
            <th>Quantidade</th>
            <td>{{sizeof($pedidos->where('status','3'))}}</td>
            <td>{{sizeof($pedidos->where('status','<>','3')->where('status','<>','7')->where('status','<>','4'))}}</td>
            <td>{{sizeof($pedidos->where('status','7'))}}</td>
            <td>{{sizeof($pedidos)}}</td>
        </tr>
        <tr>
            <th>Valor</th>
            <td>R$ {{number_format($somaTotalPedidosPagos,2)}}</td>
            <td>R$ {{number_format($somaTotalPedidosPendentes,2)}}</td>
            <td>R$ {{number_format($somaTotalPedidosCancelados,2)}}</td>
            <td>R$ {{number_format($somaTotalPedidos,2)}}</td>
        </tr>        
    </tbody>
</table>

<br><br>
	<h3 style="display: inline;">Detalhes </h3><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
        <br><?php $i=0; ?>
	<table class="table table-striped" style="border-bottom:2px solid #dddddd;">
	  <thead>
	    <tr>
	      <th>ID</th>
              <th>Ref. Code</th>
              <th>Descrição</th>
	      <th>Usuário</th>
              <th>Data</th>
	      <!--<th>Cod. PagSeguro</th>-->
              <th>Qtde</th>
              <th>Preço total produto</th>
	      <th>Frete</th>
	      <th>Taxa PagSeguro</th>
	      <th>Forma Pagamento</th>
	      <th>Status</th>
	      <th>Status Envio</th>
	      <th>Valor Total</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach($pedidos as $order)

	  	<?php $i++; 
		$status_nome ="";
		$status_envio ="-";

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
                  
	      <th scope="row">{{$order->id}}</th>  
              <td>{{$order->reference}}</td>
	      <td><h3 style="display: inline;">Livro Fé Latina</h3></td>
              <td><a data-fancybox data-type="iframe" data-src="{{route('adm_detalhes_usuario',$order->user_id)}}" href="javascript;" title="Ver detalhes do usuário" target="_blank">{{$order->getUserName($order->user_id)->name}}</a></td>
	      <td>{{date_format($order->created_at,"d/m/Y")}}</td>
	    <!--  <td>{{str_replace("-","",$order->pagseguro_transaction_code)}}</td> -->
              <td>x{{$order->qtde}}</td>
	      <td>R$ {{str_replace(".",",",number_format($order->preco_livro,2))}}</td>
	      <td>R$ {{str_replace(".",",",number_format($order->frete,2))}}</td>
	      <td>R$ {{str_replace(".",",",number_format($order->taxa_pagseguro,2))}}</td>
              <td>{{ucfirst($order->forma_pagto)}}</td>
	      <td id="status_nome">
                  @if($order->status==3)
                    <a data-fancybox data-type="iframe" data-src="{{route('adm_detalhes_pedido',$order->id)}}" href="javascript;">{{$status_nome}}</a>
                  @else
                    {{$status_nome}}
                  @endif
              </td>
	      <td style="text-align: center;">
                  {{$status_envio}}
                  @if ($order->rastreio)
                  <br><a data-fancybox data-type="iframe" data-src="{{route('adm_rastreio',$order->rastreio)}}" href="javascript;">{{$order->rastreio}}</a>
                  @endif
              </td>
	      <td>R$ {{str_replace(".",",",number_format($order->preco_total,2))}}</td>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
		 <script>	
                  $(document).ready(function() {
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
                                    },
                                afterClose :   function() {
                                    parent.location.reload();
                                }
                    });	
                   });
                </script>

@endsection