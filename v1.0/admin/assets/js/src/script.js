jQuery(document).ready(function($){
	
	// When they click bulk select, should add back all the js--select-attachment
	$('body').on('mouseenter', '.mode-select ul.attachments li .type-image', function(){
		if( !$(this).hasClass('js--select-attachment') ){
			$(this).addClass( 'js--select-attachment' );
		}
	});
	
	$('body').on('mouseenter', '.mode-edit ul.attachments li .type-image', function(){
		
		if( $(this).hasClass('js--select-attachment') ){
			$(this).removeClass( 'js--select-attachment' );
		}

		var attachment = $(this).parents('.attachment');
		var thumbnail = attachment.find('.thumbnail img');
		if( typeof thumbnail.attr('id') == 'undefined' || thumbnail.attr('id') != attachment.data('id') ){
			thumbnail.attr( 'id', attachment.data('id') );
		}


		var el = '<div class="attachment-overlay" style="background-color:rgba(0,0,0,0.1);width:100%;height:100%;position:absolute;top:0;">';
		el += '<button class="btn-edit-image wharrf-edit-image" style="margin-top:20px;">Image Editor</button>';
		el += '<button class="btn-edit-details js--select-attachment" style="margin-top:20px;">Edit Details</button>';
		el += '</div>';
		$(this).append( el );
	});

	$('body').on('mouseleave', '.mode-edit ul.attachments li .attachment-preview', function(){
		$(this).find( '.attachment-overlay' ).remove();
	});


	$('body').on('click', '.type-image .wharrf-edit-image', function(ev){
		var attachment = $(this).parents('.attachment');
		//attachment = attachment[0];

		var thumbnail = attachment.find('.thumbnail img');
		//thumbnail = thumbnail[0];
		featherEditor.launch({
			image: thumbnail.attr('id'),
			url: thumbnail.attr('src')
		}); 
		return false;
	});



	/* feather Editor */
	var featherEditor = new Aviary.Feather({
		apiKey: aviary.appkey,
		tools: 'all',
		onSave: function(imageID, newURL) {
			
			tb_show( 'Save Image','#TB_inline?width=600&height=200&inlineId=save-image-thickbox' );
			$('#TB_window').on('click','input[name=send-image-to-server]',function(ev){
				ev.preventDefault();
				$('#TB_window .wp-spinner').show();
				send_image_to_server( $('input[name=image-title]').val(), newURL, true );
			});
			
		}
	});

	// Sends the new image to the server
	function send_image_to_server( imageTitle, newURL, is_tb_true ){
		// Send to the server
		var data = {
			'action'		: 'handle_upload',
			'image-title'	: imageTitle,
			'url'			: newURL
		};

		$.post(ajaxurl, data, function(response) {
			//console.log(response);
			$('#TB_window .wp-spinner').hide();
			featherEditor.close();
			if( is_tb_true ){
				tb_remove();
			}
			location.reload();
			
		},'json');
	}

});
