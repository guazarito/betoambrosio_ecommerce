$(document).ready(function(){
	
               
                				$("#loader").css('position','absolute');
				$("#loader").css('top', ($(window).height()/2) );			
				$("#loader").css('left', ($(window).width()/2) );
                
		calculaValorTotal();
	
		$("#img_01").elevateZoom({
			zoomWindowFadeIn: 500,
			zoomWindowFadeOut: 500,
			lensFadeIn: 500,
			lensFadeOut: 500,
			gallery: 'gal1'
		}); 

		//pass the images to Fancybox
		$("#img_01").bind("click", function(e) {  
		  var ez =   $('#img_01').data('elevateZoom');	
			$.fancybox(ez.getGalleryList());
		  return false;
		});
		
		//alert($(document).height());
		
                
                $("#btn-comprar").click(function(){
                   $("#frmComprar").submit();
                });
	   });	
	   
	   $("#addItem").click(function(){	
			if(parseInt($("#txtQtd").val())<2){
				$("#txtQtd").val((parseInt($("#txtQtd").val())+1));
				calculaValorTotal();
			}
	   });
	   
	   $("#removeItem").click(function(){
			if(parseInt($("#txtQtd").val())>1){
				$("#txtQtd").val((parseInt($("#txtQtd").val())-1));
				calculaValorTotal();
			}
	   });
	   
	   function calculaValorTotal(){
              
			var valorTotal;
			var txPagSeguro;
			var qtde;
			var frete;
			var valorLivro;
			
			qtde =  parseInt($("#txtQtd").val());
			valorLivro = 80;

			if(qtde == 1){
				$("#frete").html("15,00");
			}else{
				$("#frete").html("20,00");
			}			
			frete = (parseInt($("#frete").html().replace(",",".")));
			
			valorTotal = qtde * (valorLivro);
			
			$("#valorLivro").html(valorTotal + ",00");
			$("#frm_valorLivro").val(valorTotal);
                        
			valorTotal +=frete;
			txPagSeguro = (valorTotal * 0.0399) + 0.4;
			valorTotal = valorTotal + txPagSeguro;
			$("#valorTotal").html(valorTotal.toFixed(2).replace(".",","));
			$("#taxaPagSeguro").html(txPagSeguro.toFixed(2).replace(".",","));
			
                        
                        $("#frm_valorFrete").val(frete.toFixed(2));
                        $("#frm_valorTaxa").val(txPagSeguro.toFixed(2));
                        $("#frm_qtde").val(qtde);
                        $("#frm_valorTotal").val(valorTotal.toFixed(2));
	   }
           
           