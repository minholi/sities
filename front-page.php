<?php
/**
 * Template da pagina inicial
 *
 * @package WordPress
 * @subpackage Sities
 * @since Sities 0.4.0
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

                <div id="sb-slider" class="sb-slider">
                    <img id="banner-sities" src="<?php bloginfo('stylesheet_directory'); ?>/images/banner-sities.png" title="Prestigie você também!" />
                </div>


                <div id="colunas">
                <div class="coluna" id="coluna1">
                    <a class="item-coluna" id="inscricoes" href="/inscricoes/">
                        <h2>Inscrições</h2>
                        <p>Se deseja participar do Sities, efetue sua inscrição aqui. A inscrição
                        prévia não tem custo e ao informar seus dados você estará concorrendo a
                        brindes de nossos patrocinadores.</p>
                    </a>
                    <a class="item-coluna" id="localizacao" href="/localizacao/">
                        <h2>Localização</h2>
                        <p>O Sities será realizado no campus do IFPR, na rodovia PR-323 próximo ao
                        trevo de acesso de Mariluz (sentido Guaíra). O local conta com amplo
                        estacionamento próprio.</p>
                    </a>
                </div>

                <div class="coluna" id="coluna2">
                    <a class="item-coluna" id="palestras" href="/programacao/">
                        <h2>Programação</h2>
                        <p>Veja aqui as principais atrações do Sities, os horários em que serão
                        ministradas as palestras, mini-cursos e demais atividades. Lembre-se
                        de montar seu programa pessoal.</p>
                    </a>
                    <a class="item-coluna" id="palestrantes" href="/palestrantes/">
                        <h2>Palestrantes</h2>
                        <p>Saiba quem estará ministrando palestras e mini-cursos no Sities.
                        Conheça um pouco do perfil dos palestrantes e veja quem tem o perfil
                        mais próximo ao que você procura.</p>
                    </a>
                </div>
                </div>

                <?php the_post(); ?>

                <?php the_content(); ?>

			</div><!-- #content -->
		</div><!-- #primary -->

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.slicebox.min.js"></script>
		<script type="text/javascript">
			$(function() {
				
				$('#sb-slider').slicebox({
					slicesCount			: 8,
					disperseFactor		: 30,
					sequentialRotation	: true,
					sequentialFactor	: 100
				});
				
				if( !Modernizr.csstransforms3d ) {
					$('#sb-note').show();
					
					$('#sb-examples > li:gt(2)').remove();
					
					$('body').append(
						$('script').attr( 'type', 'text/javascript' ).attr( 'src', '<?php bloginfo('stylesheet_directory'); ?>/js/jquery.easing.1.3.js' )
					);
				}	
			});
		</script>

<?php get_footer(); ?>