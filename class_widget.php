<?php
/**
 * Makes a custom Widget for displaying the Kiening Partner Link
 *
 *
 */
class Kiening_Widget extends WP_Widget {

	/**
	 * Constructor
	 *
	 * @return void
	 **/
	function Kiening_Widget() {
		$widget_ops = array( 'classname' => 'widget_kiening', 'description' => __( 'Verwenden Sie dieses Widget zum Anzeigen Ihres Kiening Partnerlinks', 'kiening' ) );
		$this->WP_Widget( 'widget_kinieng', __( 'Kiening Widget', 'kiening' ), $widget_ops );
		$this->alt_option_name = 'widget_kiening';

		add_action( 'save_post',    array(&$this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache' ) );
	}

	/**
	 * Outputs the HTML for this widget.
	 *
	 * @param array An array of standard parameters for widgets in this theme
	 * @param array An array of settings for this widget instance
	 * @return void Echoes it's output
	 **/
	function widget( $args, $instance ) {
		$cache = wp_cache_get( 'widget_kiening', 'widget' );

		if ( !is_array( $cache ) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = null;

		if ( isset( $cache[$args['widget_id']] ) ) {
			echo $cache[$args['widget_id']];
			return;
		}
		
		// get kiening settings
		$kiening_options = kw_get_global_options();
		$partnerid = $kiening_options['kw_partnerid'];
		
		ob_start();
		extract( $args, EXTR_SKIP );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Werbung', 'kiening' ) : $instance['title'], $instance, $this->id_base);

		if ( ! isset( $instance['size'] ) )
			$instance['size'] = 2;

		if ( ! $size = absint( $instance['size'] ) )
 			$size = 2;

 		$kiening_url     = "http://www.kiening.eu/partner/partnerdoor.php?partnerid=".$partnerid."&amp;bannerid=27";
 		//$kiening_img_url = "http://www.kiening.eu/partner/view.php?partnerid=".$partnerid."&amp;bannerid=27";
 		$kiening_img_url = plugin_dir_url( __FILE__ ) . "/images/banner.gif";
		if ($size == 1) $kiening_width   = "100%";
		if ($size == 2) $kiening_width   = "80%";
		if ($size == 3) $kiening_width   = "60%";
		
		echo $before_widget;
		echo $before_title;
		echo $title; // Can set this with a widget option, or omit altogether
		echo $after_title;
		?>
		<ul style="padding: 0px; list-style-type:none;">
			<li class="widget-entry-title">
				<a href="<?php echo $kiening_url; ?>" title="<?php printf( esc_attr__( 'Kiening Link', 'kiening' )); ?>" rel="bookmark" target="_blank">
					<img alt="Kiening Banner" src="<?php echo $kiening_img_url; ?>" width="<?php echo $kiening_width;?>" />
				</a>
			</li>

		</ul>
		<?php

		echo $after_widget;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set( 'widget_kiening', $cache, 'widget' );
	}

	/**
	 * Deals with the settings when they are saved by the admin. Here is
	 * where any validation should be dealt with.
	 **/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		//$instance['partnerid'] = strip_tags( $new_instance['partnerid'] );
		$instance['size'] = (int) $new_instance['size'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['widget_kiening'] ) )
			delete_option( 'widget_kiening' );

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'widget_kiening', 'widget' );
	}

	/**
	 * Displays the form for this widget on the Widgets page of the WP Admin area.
	 **/
	function form( $instance ) {
		$title     = isset( $instance['title']) ? esc_attr( $instance['title'] ) : '';
		$partnerid = isset( $instance['partnerid']) ? esc_attr( $instance['partnerid'] ) : '';
		$size      = isset( $instance['size'] ) ? absint( $instance['size'] ) : 2;
?>
			<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'kiening' ); ?></label><br/>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>

			<!-- <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'partnerid' ) ); ?>"><?php _e( 'Kiening-Partner-ID:', 'kiening' ); ?></label><br />
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'partnerid' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'partnerid' ) ); ?>" type="text" value="<?php echo esc_attr( $partnerid ); ?>" />
			</p> -->
	
			<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>"><?php _e( 'Bannergröße:', 'kiening' ); ?></label><br />
			<input id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>" type="radio" value="1" <?php echo (esc_attr( $size )==1?'checked="checked"':''); ?> /><?php _e("groß",'kiening')?><br/>
			<input id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>" type="radio" value="2" <?php echo (esc_attr( $size )==2?'checked="checked"':''); ?> /><?php _e("mittel",'kiening')?><br/>
			<input id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>" type="radio" value="3" <?php echo (esc_attr( $size )==3?'checked="checked"':''); ?> /><?php _e("klein",'kiening')?><br/>
			</p>
		<?php
	}
}
?>