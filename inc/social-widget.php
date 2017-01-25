<?php

/*--------------------------------------------------------------
# Register Social widget
--------------------------------------------------------------*/
class strt_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'social', 
			__( 'Social Icons', 'strt' ), 
			array( 'description' => __( 'Display Social Icons (Edit this menu in the menu options)', 'strt' ), )
		);
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		strt_social_menu();
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php __( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

}

function register_social() {
    register_widget( 'strt_Widget' );
}
add_action( 'widgets_init', 'register_social' );


/*--------------------------------------------------------------
# Social menu function
--------------------------------------------------------------*/
function strt_social_menu() {
	if ( has_nav_menu( 'social' ) ) {
		wp_nav_menu(
			array(
				'theme_location'	=> 'social',
				'menu_class'		=> 'social-links-menu',
				'container'			=> 'nav',
				'depth'				=> 1,
				'link_before'		=> '<span class="screen-reader-text">',
				'link_after'     => '</span>' . strt_get_svg( array( 'icon' => 'chain' ) ),
			)
		);
	}
}


/*--------------------------------------------------------------
# Register Social Menu location
--------------------------------------------------------------*/
register_nav_menus( array(
	'social' => esc_html__( 'Social Links Menu', 'strt' ), // Menu for Social Widget
) );


/*--------------------------------------------------------------
# Register Social Shortcode [social]
--------------------------------------------------------------*/
function social_shortcode($atts , $content = null) {
	ob_start();
	strt_social_menu();
	$output = ob_get_clean();
	return $output;
}
add_shortcode( 'social', 'social_shortcode' );
