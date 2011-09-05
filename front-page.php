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

                <img id="banner-sities" src="<?php bloginfo('stylesheet_directory'); ?>/images/banner-sities.png">
            
                <div id="colunas">
                <div class="coluna" id="coluna1">
                    <a class="item-coluna" id="inscricoes" href="#">
                        <h2>Inscrições</h2>
                        <p>Se deseja participar do Sities, efetue sua inscrição aqui. A inscrição
                        prévia não tem custo e ao informar seus dados você estará concorrendo a
                        brindes de nossos patrocinadores.</p>
                    </a>
                    <a class="item-coluna" id="localizacao" href="#">
                        <h2>Localização</h2>
                        <p>O Sities será realizado no campus do IFPR, na rodovia PR-323 próximo ao
                        trevo de acesso de Mariluz (sentido Guaíra). O local conta com amplo
                        estacionamento próprio.</p>
                    </a>
                </div>

                <div class="coluna" id="coluna2">
                    <a class="item-coluna" id="palestras" href="#">
                        <h2>Programação</h2>
                        <p>Veja aqui as principais atrações do Sities, os horários em que serão
                        ministradas as palestras, mini-cursos e demais atividades. Lembre-se
                        de montar seu programa pessoal.</p>
                    </a>
                    <a class="item-coluna" id="palestrantes" href="#">
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

<?php get_footer(); ?>