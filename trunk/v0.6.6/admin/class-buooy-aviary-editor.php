<?php
include_once __DIR__.'/lib/class-buooy-handle-media-upload.php';
Class Buooy_Aviary_Editor{

	public function __construct(){
		
		// Gets the options for the aviary app key
		$this->aviary_appkey = get_option( 'aviary-appkey' );
		
		// if the appkey is not set then we avoid loading everything else
		if( !$this->aviary_appkey ){ return; }
		
		add_action( 'admin_enqueue_scripts', array( $this,'enqueue_scripts') );
		if( BUOOY_AVIARY_EDITOR_MODAL == 'thickbox' ){
			add_action( 'admin_footer', array( $this,'output_thickbox') );
		}

		$Buooy_Handle_Media_Upload = new Buooy_Handle_Media_Upload;
	}

	//	========================================
	//	Admin Enqueue
	//	========================================
	public function enqueue_scripts(){
		$screen = get_current_screen();
		if( $screen->base != 'upload' ){ return; }

		//wp_enqueue_script( 'aviary-feather', 'http://feather.aviary.com/imaging/v1/editor.js', array('jquery'), NULL, true );
		wp_enqueue_script( 'aviary-feather', 'https://dme0ih8comzn4.cloudfront.net/js/feather.js', array('jquery'), NULL, true );
		wp_enqueue_script( 'buooy-image-editor', plugins_url( 'assets/js/script.min.js',__FILE__ ), array('aviary-feather'), NULL, true );
		wp_localize_script( 'buooy-image-editor' , 'aviary', array(
			'appkey' => $this->aviary_appkey
		) );
		
	}
	
	//	========================================
	//	Thickbox
	//	========================================
	public function output_thickbox(){

		$screen = get_current_screen();
		if( $screen->base != 'upload' ){ return; }

		add_thickbox();

		echo '<div id="save-image-thickbox" style="display:none;">
			<form>
				<h4>Set Image Title</h4>
				<input type="text" name="image-title" style="width: 100%"/>
				<hr>';
		submit_button( 'Save', 'primary', 'send-image-to-server', false );
		echo '<img class="wp-spinner" style="width: 16px; display:none; margin-top: 7px; margin-left: 6px;" src="/wp-admin/images/wpspin_light-2x.gif"></form>
		</div>';

	}

}
new Buooy_Aviary_Editor;