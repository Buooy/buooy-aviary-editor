<?php 
Class Buooy_Aviary_Editor_Admin{
	
	public function __construct(){
		
		// Creates class variables
		$this->script_handle = 'aviary-settings';
		$this->style_handle = 'aviary-settings';
		$this->version = time();
		$this->plugin_dir = plugins_url('assets/',__FILE__);
		$this->nonce_name = 'aviary-settings';
		$this->option_name = 'aviary-appkey';
		
		// Adds the necessary wp actions
		add_action( 'admin_menu', array($this,'submenu_page') );
		add_action( 'admin_enqueue_scripts', array( $this, 'style' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'script' ) );
		add_action( 'wp_ajax_save_appkey', array( $this, 'save_appkey' ) );
		
		// adds filters to the plugin page
		add_filter( 'plugin_action_links', array($this, 'plugin_action_links'),10, 5 );
		
	}
	
	// Adds scripts
	public function script( $hook ){
		
		if( $hook == 'settings_page_aviary_settings' ){
			
			wp_enqueue_script( $this->script_handle , $this->plugin_dir.'js/script-settings.min.js', array('jquery'), $this->version );
			
			// Creates a nonce and localizes the nonce to the above script
			wp_localize_script( $this->script_handle , 'aviary_settings', array(
				'nonce' => wp_create_nonce( $this->nonce_name )
			) );
			
		}
		
	}
	
	// Adds styling
	public function style( $hook ){
		wp_enqueue_style( $this->style_handle, $this->plugin_dir.'css/style.css', false, $this->version );
	}
	
	// Creates the submenu page
	public function submenu_page(){
		add_submenu_page( 'options-general.php', 'Aviary Image Editor Settings', 'Aviary Settings', 'manage_options', 'aviary_settings', array($this,'display') );
	}
	
	public function display(){
		include_once __DIR__.'/views/view-settings.php';
	}
	
	// Saves the aviary api key to the options table
	public function save_appkey(){
		
		// Checks the ajax nonce referer call
		if( !wp_verify_nonce( $_REQUEST['nonce'], $this->nonce_name ) ){
			wp_send_json_error( array(
				'err' => 'Please refresh your page and try again'
			) );
		}
		
		// Saves the aviary app key to the options table
		if( get_option($this->option_name) == $_POST['appkey'] || update_option( $this->option_name, $_POST['appkey'] ) ){
			wp_send_json_success(array(
				'msg' => 'We have saved your app key successfully.'
			));
		}else{
			wp_send_json_error( array(
				'err' => 'We were unable to save your appkey. Please refresh your page and try again.'
			) );
		}
		
	}
	
	// Adds the plugin action links
	public function plugin_action_links($actions, $plugin_file ){
		if( $plugin_file == 'buooy-aviary-editor/buooy-aviary-editor.php' ){
			$actions[] = '<a href="'. esc_url( get_admin_url(null, 'options-general.php?page=aviary_settings') ) .'">Settings</a>';
		}
		return $actions;
	}
	
}
new Buooy_Aviary_Editor_Admin;