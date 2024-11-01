<?php
/******************************************************************************************
* Class mdwwu_whistles_widget
* Builds the widget for adding post content to widgetized area extending WP_Widget
******************************************************************************************/
class mdwwu_whistles_content_widget extends WP_Widget {
    
    function mdwwu_whistles_content_widget() {
        $widget_ops = array( 'classname' => 'whistles-content-widget', 'description' => __( "Displays content of a Whistle in a sidebar.") );
        $this->WP_Widget( 'whistles-content-widget', __( 'Whistles Content Widget', 'whistles_content_widget' ), $widget_ops );
    }
    
    /* build the widget output to the widget area */
    function widget( $args, $instance ) {
    	
    	extract( $args );
		
		/* output the before widget content declared when sidebar is registered */
		echo $before_widget;
				
		$mdwwu_whistle_query_args = array(
			'post_type' => 'whistle',
			'post__in' => array( $instance[ 'whistleid' ] ),
			'posts_per_page' => '1'
		);
		
		/* start the whistle query */
	    $mdwwu_whistle_query = new WP_Query( $mdwwu_whistle_query_args );
	    
	    /* begin the query loop */
	    while( $mdwwu_whistle_query->have_posts() ) : $mdwwu_whistle_query->the_post();
	    		
    		/* do action for running code before whistle output */
    		do_action( 'mdwwu_before_whistle_widget', get_the_ID() );
    		
			/* set the output of the widget */
			$mdwwu_widget_output = '<div id="whistle-' . get_the_ID() . '" class="' . implode(' ', get_post_class() ) . '">';
			$mdwwu_widget_output .= '<h3 class="whistle-title">' . $instance[ 'title' ] . '</h3>';
			$mdwwu_widget_output .= '<div class="entry-content">' . wpautop( get_the_content() ) . '</div></div>';
			
			/* output whistle widget content running through a filter first */
			echo apply_filters( 'mdwwu_whistle_widget_content', $mdwwu_widget_output );
			
			/* do action for running code after whistle output */
    		do_action( 'mdwwu_after_whistle_widget', get_the_ID() );
	    
		/* end the loop */
		endwhile;
		
		/* reset the query */
		wp_reset_query();
		
		/* output the after widget content declared when sidebar is registered */
		echo $after_widget; 
		        
    } // end widget output
    
    /* widget update function */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
        $instance[ 'whistleid' ] = (int) $new_instance[ 'whistleid' ];
        return $instance;
    }
    
    /* widget dashboard output */
    function form( $instance ) {
    	if( isset( $instance[ 'title' ] ) ) {
	    	$title = esc_attr( $instance[ 'title' ] );
    	} else {
	    	$title = '';
    	}
        if( isset( $instance[ 'whistleid' ] ) ) {
       		$whistleid = esc_attr( $instance[ 'whistleid' ] );
       	} else {
	       	$whistleid = '';
       	}
       	?>
       	
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>">
        <?php _e( 'Title for whistle:' ); ?>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title'); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
 
        <p><label for="<?php echo $this->get_field_id( 'whistleid' ); ?>">
        <?php _e( 'Whistle To Show:' ); ?><br />
        <?php mdwwu_generate_post_select( $this->get_field_name( 'whistleid' ), 'whistle', $whistleid ); ?>
        </label>
		</p>
		        		
    <?php
    }

} // ends class

/* function to register to the new widget */
function mdwwu_register_whistles_widget() {

	register_widget( 'mdwwu_whistles_content_widget' );
	
}