<?php
Class Buooy_Aviary_Editor_AJAX{

	public function __construct(){
		add_action( 'wp_ajax_buooy_aviary_editor_request_image', array($this,'request_image') );
	}

	public function request_image(){
		
		// Checks if the current user can even do anything at all
		if( !current_user_can('upload_files') ){
			wp_send_json_error();
		}
		
		// Returns the requested image
		if( !empty( $_POST['attachment_id'] ) && is_numeric( $_POST['attachment_id'] ) ){
			wp_send_json_success(
				array(
					'attachment_url' => wp_get_attachment_url( $_POST['attachment_id'] )
				)
			);
		}else{
			wp_send_json_error();
		}
		
	}

}
new Buooy_Aviary_Editor_AJAX;