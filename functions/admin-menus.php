<?php
/******************************************************************************************
* Class mdwwu_remove_menus
* Remove some sub menus from the admin menu
******************************************************************************************/
function mdwwu_remove_menus() {
	
	/* remove the sub menus */
	remove_submenu_page(
		'themes.php',
		'edit-tags.php?taxonomy=whistle_group&amp;post_type=whistle'
	);
	
}

add_action( 'admin_menu', 'mdwwu_remove_menus', 999 );