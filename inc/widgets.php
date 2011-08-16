<?php
/**
 * Widgets do Sities
 *
 * - Widget de Banners: Sities_Banner_Widget
 *
 * Mais informações: http://codex.wordpress.org/Widgets_API#Developing_Widgets
 *
 * @package WordPress
 * @subpackage Sities
 * @since Sities 0.2.0
 */
 
 /**
 * Widget de Banners
 */
class Sities_Banner_Widget extends WP_Widget {
	/** constructor */
	function Sities_Banner_Widget() {
		parent::WP_Widget( 'sities_banner_widget', $name = 'Banners', $widget_ops = array( 'description' => 'Banners de parceiros e promotores do evento' ) );
	}

	/** @see WP_Widget::widget */
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title; ?>
		Hello, World!
		<?php echo $after_widget;
	}

	/** @see WP_Widget::update */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

	/** @see WP_Widget::form */
	function form( $instance ) {
		if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
		}
		else {
			$title = 'Novo Título';
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<?php 
	}

} // class Sities_Banner_Widget
 
?>