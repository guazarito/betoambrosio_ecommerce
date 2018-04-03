@extends('layout')

@section('content')

	 <link href="{{asset('css/bootstrap-editable.css')}}" rel="stylesheet">
         <script src="{{asset('js/bootstrap-editable.js')}}"></script>
	 <script src="{{asset('js/meusdados.js')}}"></script>

<style>
    body{
        background-color: #fff;
    }
</style>

<div class="container meus_pedidos">
	<h1 id="meuspedidos_title">Meus Dados</h1>
	<br>
@if (isset($eu))

	  	<p>Nome: <a href="#" title="Clique para editar" class="editable_field" data-type="text" data-pk="{{$eu->id}}" data-url="{{ route('adm.edita_meusdados_inline', ['name',$eu->id])}}">{{$eu->name}}</a></p>
		<p>email: {{$eu->email}}</p>
		<p>Celular: <a href="#" title="Clique para editar" class="editable_field" data-type="text" data-pk="{{$eu->id}}" data-url="{{ route('adm.edita_meusdados_inline', ['celular',$eu->id])}}">{{$eu->celular}}</a></p>
		<br>
                <h2 class="title_small">Endereço</h2>
                <p>CEP: <a href="#" title="Clique para editar" class="editable_field" data-type="text" data-pk="{{$eu->id}}" data-url="{{ route('adm.edita_meusdados_inline', ['cep',$eu->id])}}">{{$eu->cep}}</a></p>
		<p>Cidade: <a href="#" title="Clique para editar" class="editable_field" data-type="text" data-pk="{{$eu->id}}" data-url="{{ route('adm.edita_meusdados_inline', ['cidade',$eu->id])}}">{{$eu->cidade}}</a></p>
		<p>Estado: <a href="#" title="Clique para editar" class="editable_field_uf" data-type="text" data-pk="{{$eu->id}}" data-url="{{ route('adm.edita_meusdados_inline', ['estado',$eu->id])}}">{{$eu->estado}}</a></p>
		                        <span class="alert alert-danger cpf_invalido">
                                            <strong>ATENÇÃO: O Estado deve conter 2 caracteres. Ex: SP.</strong>
                                        </span>
                <p>Bairro: <a href="#" title="Clique para editar" class="editable_field" data-type="text" data-pk="{{$eu->id}}" data-url="{{ route('adm.edita_meusdados_inline', ['bairro',$eu->id])}}">{{$eu->bairro}}</a></p>
		<p>Endereço: <a href="#" title="Clique para editar" class="editable_field" data-type="text" data-pk="{{$eu->id}}" data-url="{{ route('adm.edita_meusdados_inline', ['rua',$eu->id])}}">{{$eu->rua}}</a></p>
		<p>Numero: <a href="#" title="Clique para editar" class="editable_field" data-type="text" data-pk="{{$eu->id}}" data-url="{{ route('adm.edita_meusdados_inline', ['numero',$eu->id])}}">{{$eu->numero}}</a></p>
		@if (isset($eu->complemento))
                <p>Complemento: <a href="#" title="Clique para editar" class="editable_field" data-type="text" data-pk="{{$eu->id}}" data-url="{{ route('adm.edita_meusdados_inline', ['complemento',$eu->id])}}">{{$eu->complemento}}</a></p>
                @else
                <p>Complemento: <a href="#" style="font-style:italic; color: #c9c9c9;" title="Clique para editar" class="editable_field" data-type="text" data-pk="{{$eu->id}}" data-url="{{ route('adm.edita_meusdados_inline', ['complemento',$eu->id])}}">clique para adicionar</a></p>           
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



@endsection