<?php
Class Buooy_Handle_Media_Upload{

	public function __construct(){
		add_action( 'wp_ajax_handle_upload', array($this,'handle_upload') );
	}

	public function handle_upload(){

		$url = $_POST['url'];
		$tmp = download_url( $url );
		$post_id = 0;
		$file_array = array();

		// Set variables for storage
		// fix file filename for query strings
		preg_match('/[^\?]+\.(jpg|jpe|jpeg|gif|png)/i', $url, $matches);
		$file_array['name'] = basename($matches[0]);
		$file_array['tmp_name'] = $tmp;

		// If error storing temporarily, unlink
		if ( is_wp_error( $tmp ) ) {
			@unlink($file_array['tmp_name']);
			$file_array['tmp_name'] = '';
		}

		// do the validation and storage stuff
		$post_data['post_title']	= $_POST['image-title'];
		$result = media_handle_sideload( $file_array, $post_id, null, $post_data );

		if( is_wp_error($result) ){
			error_log( $result, __DIR__.'/log.log' );
			wp_send_json( array(
				'result'	=>	false,
				'title'		=>	$_POST['image-title'],
				'error'		=>	$result,
				'msg'		=>	'Error'
			) );
		}else{
			wp_send_json( array(
				'result'	=>	true,
				'title'		=> 	$_POST['image-title'],
				'id'		=>	$result
			) );
		}
	}

}
