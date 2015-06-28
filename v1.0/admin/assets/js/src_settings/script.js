jQuery(document).ready(function($){
	
	//	On click, saves the aviary app key to the server
	$('#add-aviary-app-key-btn').click(function(){
		
		var data = {
			nonce : aviary_settings.nonce,
			action : 'save_appkey',
			appkey : $('[name=aviary-app-key]').val()
		}
		
		$.post( ajaxurl, data, function(response){

			if(response.success){
				$('#aviary-app-key-msg label').addClass('alert-success');
				$('#aviary-app-key-msg label').html(response.data.msg);
			}else{
				$('#aviary-app-key-msg label').addClass('alert-error');
				$('#aviary-app-key-msg label').html(response.data.err);
			}
			
			
		} );
		
	});

});
