<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
* Dashboard and Administrative Functionality
*----------------------------------------------------------------------------*/
if( is_admin() ){
	
	// Checks that the user is on localhost. Aviary does not work on localhost
	if( !is_on_localhost() ){
		
		include_once __DIR__.'/admin/class-buooy-aviary-editor-admin.php';
		include_once __DIR__.'/admin/class-buooy-aviary-editor.php';
		
	}
}

// Checks if the user is on localhost
function is_on_localhost(){
	
	$whitelist = array(	'127.0.0.1','::1' );
	if(in_array($_SERVER['REMOTE_ADDR'], $whitelist) ){
		
		// Outputs the warning banner
		add_action( 'admin_footer', 'aviary_localhost_warning' );
		return true;
	}
	return false;
	
}

// Displays the localhost warning that says you cannot use it without an online server
function aviary_localhost_warning(){
	
	$banner = 	'<div id="warning-banner" style="width: 100%; color: white; position:fixed; bottom: 0; z-index:9999; background-color: #c0392b;">';
	$banner .=		'<p style="padding-left: 20px; padding-right: 20px;">';
	$banner .=			'Please note that you are on localhost and Aviary requires you to have a hosted server.';
	$banner .=			'<span style="float:right; font-size: 18px; cursor:pointer;" onclick="document.getElementById(\'warning-banner\').style.display = \'none\'">&times;</span>';
	$banner .=		'</p>';
	$banner .=	'</div>';
	
	echo $banner;
	
}