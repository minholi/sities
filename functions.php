<?php
/**
 * Funções e configurações do Sities
 *
 * @package WordPress
 * @subpackage Sities
 * @since Sities 0.2.0
 */

/**
 * Manda o WordPress rodar a sities_setup() quando o 'after_setup_theme' rodar.
 */
add_action( 'after_setup_theme', 'sities_setup' );

function sities_setup() {
    // Pega os widgets do Sities.
    require( dirname( __FILE__ ) . '/inc/widgets.php' );
}

/**
 * Registra o widget de banner.
 */
function sities_widgets_init() {
	register_widget( 'Sities_Banner_Widget' );
}
add_action( 'widgets_init', 'sities_widgets_init' );

?>