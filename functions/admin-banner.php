<?php
/***************************************************************
* Function mdwwu_admin_notices_banner()
* Add the mdwwu header to the admin pages at the top.
***************************************************************/
function mdwwu_admin_notices_banner() {

	global $pagenow; global $typenow;
	
	/* get the current admin page */
	$mdwwu_current_admin_page = $pagenow;
		
	switch( $mdwwu_current_admin_page ) {
	
		/* if this is a post edit screen */
		case 'edit.php':
			
			/* check if this is the post post type */
			if( 'whistle' == $typenow ) {
			
				/* get all the taxonomies for this post type */
				$mdwwu_taxononomies = get_object_taxonomies( $typenow );
				
				/* check we have any taxonomies to show */
				if( ! empty( $mdwwu_taxononomies ) ) {
				
					/* output wrapping div */
					echo '<div class="admin-notice-banner" style="margin-top: 3%;"><div class="wrap posttype-taxonomies">';
					
					/* loop through our taxonomies adding to our variable each time */
					foreach( $mdwwu_taxononomies as $mdwwu_taxononomy ) {
		
						/* get the taxonomy */
						$mdwwu_taxononomy_object = get_taxonomy( $mdwwu_taxononomy );
		
						/* output a link to the taxonomy terms edit screen with taxonomy name label as link text */
						echo '<a class="add-new-h2" href="' . admin_url( 'edit-tags.php?taxonomy=' . $mdwwu_taxononomy ) . '">' . $mdwwu_taxononomy_object->labels->name . '</a>';
		
					} // end foreach
					
					/* close div */
					echo '</div></div>';
					
				} // end if have taxonomies
				
			}
			
			/* break out of the switch statement */
	    	break;
	
	}

}