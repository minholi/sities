<?php
/**
 * Funções e configurações do Sities
 *
 * @package WordPress
 * @subpackage Sities
 * @since Sities 0.2.0
 */


/**
 * Cria o Post Type Palestra
 */
add_action( 'init', 'create_sities_palestra' );

function create_sities_palestra() {
    register_post_type( 'sities_palestra',
        array(
            'labels' => array(
                'name' => __( 'Palestras' ),
                'singular_name' => __( 'Palestra' ),
                'add_new' => __( 'Adicionar Nova' ),
                'add_new_item' => __( 'Adicionar Nova Palestra' ),
                'edit_item' => __( 'Editar Palestra' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'palestras', 'with_front' => False),
            'menu_position' => 5
        )
    );
}


/**
 * Cria o Post Type Palestrante
 */
add_action( 'init', 'create_sities_palestrante' );

function create_sities_palestrante() {
    register_post_type( 'sities_palestrante',
        array(
            'labels' => array(
                'name' => __( 'Palestrantes' ),
                'singular_name' => __( 'Palestrante' ),
                'add_new_item' => __( 'Adicionar Novo Palestrante' ),
                'edit_item' => __( 'Editar Palestrante' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'palestrantes', 'with_front' => False),
            'menu_position' => 5
        )
    );
}


/**
 * Cria uma ligação entre Palestra e Palestrante
 */
add_action( 'init', 'sities_connection_types', 100 );

function sities_connection_types() {
    if ( !function_exists( 'p2p_register_connection_type' ) )
        return;

    p2p_register_connection_type( 
        array( 
            'from' => 'sities_palestra',
            'to' => 'sities_palestrante'
        )
    );
}


/**
 * Cria taxonomia para classificação dos tipos de palestras 
 * (mini cursos, palestras, mesa redonda, etc.)
 */
add_action( 'init', 'create_sities_taxonomies', 0 );

function create_sities_taxonomies() {
    register_taxonomy('sities_palestra_tipo','sities_palestra',
        array(
            'hierarchical' => True,
            'labels' => array(
                'name' => __( 'Tipos' ),
                'singular_name' => __( 'Tipo' ),
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => __( 'Editar Tipo' ), 
                'update_item' => __( 'Atualizar Tipo' ),
                'add_new_item' => __( 'Adicionar Novo Tipo' ),
                'new_item_name' => __( 'Novo Tipo' ),
                'menu_name' => __( 'Tipos' ),
            ),
        )
    );
}

?>