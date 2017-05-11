<?php 
/*
@package vezba
Widget class
*/

class Section_widget extends WP_Widget {

	//setup the widget name, desc, etc...
	public function __construct() {

		$widget_ops = array(
			'classname' => 'section_widget',
			'description' => 'Custom Section Widget',
		);
		parent::__construct( 'section_profile', 'Section Profile', $widget_ops );
	}
	//backend display of widget
	public function form( $instance ) {
		echo '<p><strong>No options for this widget!</strong><br/>Control from here <a href="./admin.php?page=vezba_options">This Page</a></p>';
	}

	//frontend display of widget
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		echo '<h2>IWA network sections</h2>';
		
		// Section ID
		$links = get_section_post_types();
		
		// Get all posts
		foreach( $links as $link ) {
			if( is_array( $link ) ) {				
				$post_link =  $link['href'];
				$get_json_post = wp_remote_get( $post_link );
				$post_body = wp_remote_retrieve_body( $get_json_post );
				$post = json_decode( $post_body, true );
				// Display posts
				$post_number = 0;
				if( !empty ( $post ) ) {
					foreach( $post as $p ) {					
						echo '<a href="#" data-toggle="modal" data-target="#myModal" id=' . $p['id'] . '>' . $p['title']['rendered'] . '</a><br/>';
					}
				} 				
			}
		}?>

		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
		      </div>
		      <div id="post-detail" class="modal-body">
		       content
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>

		<?php
		echo $args['after_widget'];
	}
}

add_action( 'widgets_init', function() {
	register_widget( 'Section_widget' );
});

