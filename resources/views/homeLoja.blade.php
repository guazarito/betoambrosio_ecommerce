@extends('layout')



@section('content')

	<div class="container">
	
		<div class="row">
                    @if (!$isMobile)
			<div class="col-md-7 col-sm-12">
				<div id="img_activated">
					<img id="img_01" src="img/1.png" data-zoom-image="img/1.png"/>
				</div>

				<div id="gal1">
					  <a href="#" data-image="img/1.png" data-zoom-image="img/1.png">
						<img id="img_01" class="img_thumb" src="img/1.png" />
					  </a>
					  <a href="#" data-image="img/2.png" data-zoom-image="img/2.png">
						<img id="img_01" class="img_thumb" src="img/2.png" />
					  </a>
					  <a href="#" data-image="img/3.png" data-zoom-image="img/3.png">
						<img id="img_01" class="img_thumb" src="img/3.png" />
					  </a>
					  <a href="#" data-image="img/4.png" data-zoom-image="img/4.png">
						<img id="img_01" class="img_thumb" src="img/4.png" />
					  </a>					  
				</div><!-- gal1 -->		  
			</div><!--col-->
		    @else
                    <script src="{{asset('js/jquery.bxslider.js')}}"></script>
                    <link href="{{asset('css/jquery.bxslider.css')}}" rel="stylesheet">

                            <div id="slider_header">
                                <ul class="bxslider"> 
                                    <li><center><img src="img/1.png"/></center></li>

                                    <li><center><img src="img/2.png"/></center></li>

                                    <li><center><img src="img/3.png"/></center></li>

                                    <li><center><img src="img/4.png"/></center></li>
                                </ul>
                            </div>
                        <script>
                        $(document).ready(function () {
                            $('.bxslider').bxSlider({
                                auto: true,
                                controls: true,
                                pager: true,
                                mode: 'fade',
                                slideWidth: 800,
                                preloadImages: 'all'
                            });
                        });
                        </script>
                    @endif
			<div class="col-md-5 col-sm-12">
				<div id="product-details">
					<h1>Livro FÉ LATINA</h1>
					<p>Uma volta de bicicleta pela América Latina.</p><p>Um livro feito a base de amor, feijão e bicicleta!</p>
					
                                        <div id="infos">
                                            <h3>Detalhes:</h3>
                                            <ul>
                                                <li>Capa dura com laminação fosca e reserva de verniz UV localizado</li>
                                                <li>320 Páginas de texto em papel Suzano Pólen Bold 90g</li>
                                                <li>90 Páginas de fotos em papel couché fosco 115 gramas</li>
                                                <li>Medidas do livro: 25 x 17 x 4.5</li>
                                            </ul>
                                        </div>
                                        
					<div id="preco">
                                                <p><b>Valor livro:</b> R$ <span id="valorLivro"></span></p>
						<p><b>Frete (todo Brasil):</b> R$ <span id="frete"></span></p>
						<p><b>Taxa PagSeguro:</b> R$ <span id="taxaPagSeguro"></span></p>
						<p style= "display: inline;"><b>Quantidade:</b></p>
						
						<button title="Remover" id="removeItem">-</button>
						<input name="qtd" id="txtQtd" value="1" size="2" title="Quant." type="text" readonly>
						<button title="Adicionar" id="addItem">+</button>
						
						<p><b>Valor Total:</b> R$ <span id="valorTotal"></span></p>

					</div>
                                        
                                                                                        
                                           
                                        <form name="frmComprar" id="frmComprar" action="/comprar" method="POST" enctype="multipart/form-data">
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="frm_valorLivro" id="frm_valorLivro"/>
                                            <input type="hidden" name="frm_valorFrete" id="frm_valorFrete"/>
                                            <input type="hidden" name="frm_valorTaxa" id="frm_valorTaxa"/>
                                            <input type="hidden" name="frm_qtde" id="frm_qtde"/>
                                            <input type="hidden" name="frm_valorTotal" id="frm_valorTotal"/>    
                                        </form>
                                        <center>
                                            <a id="btn-comprar"  class="btn btn-success" role="button" style="padding:10px 50px; margin-right: 20px;">COMPRAR</a>
                                            <img style="height:30px;" src="/img/pagseguro.png">
                                        </center>
                                </div>
			</div>
			
			
		</div><!--row-->
	 </div> <!--container-->
@endsection

@section('frontjs')
<script src="js/front.js"></script>
@endsection