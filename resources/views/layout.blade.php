<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Loja Beto Ambrosio">

    <title>
       Loja Beto Ambrosio
    </title>

   
    <meta property="og:url"    content="http://loja.betoambrosio.com.br" />
    <meta property="og:type"   content="website" />
    <meta property="og:title"  content="Loja Beto Ambrosio" />

    <meta property="og:image"  content="http://loja.betoambrosio.com.br/img/fb.png" />

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
    <!-- styles -->
	
	
	<link href="{{asset('css/preloadme/styles.css')}}" rel="stylesheet">
	
    <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
	
	
    
    <link href="{{asset('css/style.default.css')}}" rel="stylesheet" id="theme-stylesheet">

    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

    <script src="{{asset('js/jquery-1.8.3.min.js')}}"></script>
    <script src="{{asset('js/preloadme/preloadme.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
    <script src="{{asset('js/jquery.elevatezoom.js')}}"></script>
    
    
<script>
    $(document).ready(function(){
         $('.inner_logo').delay(550).append("<h1 class='navbar-brand animated zoomInUp' id='lojaLogo'>Loja</h1>");
         if(window.location.pathname == "/"){
             $('#a_home').addClass("actived");
         }else{
             $('#a_home').removeClass("actived");
         }
         if(window.location.pathname == "/ajuda"){
             $('#a_help').addClass("actived");
         }else{
             $('#a_help').removeClass("actived");
         }
    });	
</script>  
</head>

<body>
	<div id="preloader">
	  <div id="status">&nbsp;</div>
	</div>
	
    <div id="top">
		<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6 user">
                                            @auth
                                            <li class="dropdown" style="list-style: none;">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                    <p><span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{ Auth::user()->name }} <span class="caret"></span></p>
                                                </a>
                                                    <ul class="dropdown-menu" role="menu">
                                                     @if (Auth::user()->role==1)   
                                                         <li>
                                                            <a href="{{route('adm_lista_pedidos')}}">Ver/Gerenciar pedidos</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{route('adm_lista_usuarios')}}">Ver usuários cadastrados</a>
                                                        </li>                                   

                                                        <li class="divider"></li>
                                                    @endif 
                                                        <li>
                                                            <a href="{{route('meuspedidos')}}">Meus pedidos</a>
                                                        </li>
                                                         <li>
                                                            <a href="{{route('meusdados')}}">Meus dados</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{route('help')}}">Ajuda</a>
                                                        </li>
                                                       <li>
                                                            <a href="{{ route('logout') }}"
                                                                onclick="event.preventDefault();
                                                                         document.getElementById('logout-form').submit();">
                                                                Sair
                                                            </a>

                                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                                {{ csrf_field() }}
                                                            </form>
                                                        </li>
                                                    </ul>
                                            </li>
                                            @endauth
					</div>
				<div class="col-md-6 col-sm-6">
                                    <ul class="menu">
                                            @guest
						<li>
							<a href="/login">Login</a>
						</li>
						<li>
							<a href="/register">Cadastre-se</a>
						</li>
                                                <li>
							<a href="/ajuda">Contato</a>
						</li>
                                            @else
                                            <?php
                                            $num_carrinho = 0;
                                            if (Session::has('dados_compra')) {
                                                $num_carrinho = 1;
                                            }
                                            ?>
                                             <li><a href="/comprar"><span class="glyphicon glyphicon-shopping-cart"></span> ({{$num_carrinho}})</a></li>
                                            @endguest
					</ul>
				</div>
			</div>
		</div>
	</div>
      <nav class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header">
			<div class="inner_logo">
				<a class='navbar-brand page-scroll' href='{{route('index')}}' style='font-size: 5em;'>BETO AMBROSIO</a>
				
			</div>
          </div>
          <div id="navbar" class="navbar-collapse collapse">

            <ul class="nav navbar-nav navbar-right">
              <li id="a_home"><a href="{{route('index')}}"><span class="glyphicon glyphicon-home"></span>  Home </a></li>
              <li id="a_help"><a href="{{route('help')}}"><span class="glyphicon glyphicon-question-sign"></span>  Ajuda</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

    @yield('content')
	 
  <footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 copyright">
                <span>
				Copyright &copy; loja.betoambrosio.com.br<br>
				Site: <a href="http://www.betoambrosio.com.br" style="color: #000;" target="_blank">www.betoambrosio.com.br</a>
				</br></br>
				Desenvolvidor por <a href="mailto:guazarito@gmail.com" style="color: #000;">Gustavo Azarito</a>
				</span>
            </div>
            <div class="col-md-4">
                <ul class="list-inline social-buttons">
                	<li><a href="http://www.facebook.com/betoambrosiofoto/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="http://www.instagram.com/betoambrosiofoto/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                </ul>
            </div>
            <div class="col-md-4" id="facebook">
				<iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fbetoambrosiofoto&width=450&layout=standard&action=like&size=small&show_faces=true&share=true&height=80&appId=405246922874434" height="80" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
			</div>
        </div>
    </div>
</footer>


@yield('frontjs')
 

</body>

</html>