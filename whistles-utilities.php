<?php
/*
Plugin Name: Whistles Utilities
Plugin URI: https://github.com/wpmark/whistles-utilities
Description: A WordPress plugin which provides a set of addon utilities to the Whistles plugin. Changes the post type name/labels to Snippets as well as providing a widget to allow users to show one Whisltes in a sidebar rather than as a group.
Version: 0.1
Author: Mark Wilkinson
Author URI: http://markwilkinson.me
License: GPLv2 or later
*/

/* include widgets file */
require_once( dirname( __FILE__ ) . '/functions/widgets.php' );

/* include widgets file */
require_once( dirname( __FILE__ ) . '/functions/template-tags.php' );

/* include admin menus file */
require_once( dirname( __FILE__ ) . '/functions/admin-menus.php' );

/* include admin banner file */
require_once( dirname( __FILE__ ) . '/functions/admin-banner.php' );

/***************************************************************
* Function mdwwu_is_whistles_active()
* Checks whether whistles plugin is active or not.
* @return boolen
***************************************************************/
function mdwwu_is_whistles_active() {
	
	/* allow access to the is_plugin_active function */
	include_once( ABSPATH.'wp-admin/includes/plugin.php' );
	
	/* check whether whistles is active */
	if ( is_plugin_active( 'whistles/whistles.php' ) ) {
		
		return true;
	
	/* whistles plugin not active */	
	} else {
		
		return false;
		
	} // end if whistles plugin active
	
}

/***************************************************************
* Function mdwwu_admin_activation_notice()
* Adds an activation notice to inform user that Whistles plugin
* is needed for functionality to work.
***************************************************************/
function mdwwu_admin_activation_notice() {
	
	global $pagenow;
	
	/* check we are on the plugins page */
	if( $pagenow != 'plugins.php' )
		return;
	
	/* check the whistles plugin is not active */
	if( ! mdwwu_is_whistles_active() ) {
		
		/* whistles plugin not active - inform the user with an admin message */
		echo '<div class="error whistles-utilities-nag"><p>Presently, the Whistles Utilities will not function. Please install the <a href="http://wordpress.org/plugins/whistles/">Whistles plugin</a> to see the plugin functionality.</p></div>';
				
	}
	
	
}

add_action( 'admin_notices', 'mdwwu_admin_activation_notice' );

/* run all our functions through hooks only if the whistles plugin is active */
if( mdwwu_is_whistles_active() ) {
	
	/* add admin banner actions for taxonomy link change */
	add_action( 'admin_notices', 'mdwwu_admin_notices_banner' );
		
	/* hook new widget into wordpress */
	add_action( 'widgets_init', 'mdwwu_register_whistles_widget' );
	
}