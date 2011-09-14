<?php
/**
 * Rodape do tema do Sities
 *
 * @package WordPress
 * @subpackage Sities
 * @since Sities 0.4.0
 */
?>

	</div><!-- #main -->

	<footer id="colophon" role="contentinfo">

			<?php
				/* A sidebar in the footer? Yep. You can can customize
				 * your footer with three columns of widgets.
				 */
				get_sidebar( 'footer' );
			?>

			<div id="site-generator">
				<?php do_action( 'twentyeleven_credits' ); ?>
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentyeleven' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentyeleven' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'twentyeleven' ), 'WordPress' ); ?></a> /
                <a href="http://minholi.com/blog">Desenvolvido por Marcelo Minholi</a>
                <div id="endereco">Instituto Federal do Paraná - Campus Umuarama. Endereço: Rodovia PR 323, s/n - Parque Industrial - CEP 87507-014 - Umuarama - Paraná - Brasil. Telefone: (0xx44) 3361-6200</div>
			</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>