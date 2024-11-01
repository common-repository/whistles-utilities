<?php
/******************************************************************************************
* Function mdwwu_generate_post_select
* Creates a Dropdown list of posts for a specified post type passed to the function
******************************************************************************************/
function mdwwu_generate_post_select( $select_id, $post_type, $selected = 0 ) {
	
	/* gets the post type object for the post type passed to function */
    $mdwwu_post_type_object = get_post_type_object( $post_type );
    
    /* gets the label name of the post type */
    $mdwwu_label = $mdwwu_post_type_object->label;
    
    /* set some args for getting posts */
    $mdwwu_posts_args = array(
    	'post_type'=> $post_type,
    	'post_status'=> 'publish',
    	'suppress_filters' => false,
    	'posts_per_page'=> -1
    );
    
    /* get an array of all the posts for this post type */
    $mdwwu_posts = get_posts( $mdwwu_posts_args );
    
    /* build the select input */
    echo '<select name="'. $select_id .'" id="'.$select_id.'">';
    echo '<option value = "" >--- Select a Whistle ---</option>';
    
    /* loop through each post outputing as an option in the select input */
    foreach ( $mdwwu_posts as $mdwwu_post ) {
        echo '<option value="', $mdwwu_post->ID, '"', $selected == $mdwwu_post->ID ? ' selected="selected"' : '', '>', $mdwwu_post->post_title, '</option>';
    }
    
    /* end the select input */
    echo '</select>';
}