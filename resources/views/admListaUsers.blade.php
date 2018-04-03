@extends('layout')

@section('content')

<style>
    body{
        background-color: #fff;
    }
    
  
  footer{
  position: absolute;
  bottom: 0;
  width: 100%;
  }

</style>

<div class="container meus_pedidos">
	<h1 id="meuspedidos_title">Usuários</h1>
	<br>
@if (sizeof($users)>0)
	<?php $i=0; ?>
	<table class="table" style="border-bottom:2px solid #dddddd;">
	  <thead>
	    <tr>
	      <th>ID</th>
	      <th>Nome</th>
	      <th>Email</th>
	      <th>Celular</th>
	      <th>Data do Cadastro</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach($users as $user)

	    <tr>
	      <th scope="row">{{$user->id}}</th>
              <td><a data-fancybox data-type="iframe" data-src="{{route('adm_detalhes_usuario',$user->id)}}" href="javascript;" title="Ver detalhes usuário">{{$user->name}}</a></td>
	      <td>{{$user->email}}</td>
	      <td>{{$user->celular}}</td>
	      <td>{{date_format($user->created_at,"d/m/Y")}}</td>
	    </tr>
	    @endforeach
	  </tbody>
	</table>

@else
<p>Nenhum user encontrado.</p>

@endif
</div><!--container-->

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