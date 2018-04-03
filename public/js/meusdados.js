		$(document).ready(function() {
			$.fn.editable.defaults.mode = 'inline';

			$('.editable_field').editable({
				escape: true
			});

			$('.editable_field_uf').editable({
				escape: true,
                                validate: function(value) {
                                  
                                    if(value.length != 2) {
                                        alert('Estado deve conter 2 caracteres');
                                        $(".cpf_invalido").css('display','block');
                                    }else{
                                        $(".cpf_invalido").css('display','none');
                                    }
                                }
			});                    
                        
		});