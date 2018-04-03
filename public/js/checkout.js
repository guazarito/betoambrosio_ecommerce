


$(document).ready(function(){
	
    $('#frmCheckout input').on('change', function() {
        if($('input[name=optradio]:checked', '#frmCheckout').val() == "cartaoCredito"){
            $("#cartao_credito").css('display','block');
            $("#boletobanc").css('display','none');
            
            $("#endereco_entrega").css('display','block');
            $("#botao_pagto_boleto").css('display','none');
            $("#botao_pagto_cartao").css('display','block');
            
        }else{
            $("#cartao_credito").css('display','none');
            $("#boletobanc").css('display','block');
            
            $("#endereco_entrega").css('display','block');
            $("#botao_pagto_boleto").css('display','block');
            $("#botao_pagto_cartao").css('display','none');
        }
     });
    
});