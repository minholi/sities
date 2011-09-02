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
            'supports' => array('title', 'editor', 'thumbnail'),
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


/**
 * Custom fields do Post Type Palestra
 */
$palestra_details = 
    array (
        "palestra-data"  => array(
            "name" =>  "palestra-data",
            "type" =>  "input",
            "title"  => "Data",
            "description"  => "Data da realização da palestra. Ex.: 15/10/2011.",
            "scope"  => array("palestra",)
        ),
        "palestra-hora"  => array(
            "name" =>  "palestra-hora",
            "type" =>  "input",
            "title"  => "Hora",
            "description"  => "Hora da realização da palestra. Ex.: 21:00.",
            "scope"  => array("palestra",)
        )    
    ); 

    
function generate_palestra_form() {
    global $post, $palestra_details;

    foreach($palestra_details as $meta_box) {
        echo '<input type="hidden" name="'.$meta_box['name'].'_noncename"  id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce(  plugin_basename(__FILE__) ).'" />';
        echo '<div><span  style="width:200px;  float:left">'.$meta_box['title'].'</span>';
        if( $meta_box['type'] == "input" )  { 
            $meta_box_value =  get_post_meta($post->ID, $meta_box['name'], true);
            if($meta_box_value ==  "")
                $meta_box_value =  $meta_box['std'];
            echo'<input  type="text" name="'.$meta_box['name'].'"  value="'.$meta_box_value.'" size="98" /><br />';
        } elseif ( $meta_box['type'] ==  "select" ) {
            echo'<select name="'.$meta_box['name'].'">';
            foreach ($meta_box['options'] as  $option) {
                echo'<option';
                if (  get_post_meta($post->ID, $meta_box['name'], true) == $option ) { 
                    echo '  selected="selected"'; 
                } elseif ( $option ==  $meta_box['std'] ) { 
                    echo '  selected="selected"'; 
                } 
                echo'>'.  $option .'</option>';
            }
            echo'</select>';
        }
        echo '</div>';
        echo '<p style="font-size: 80%; color: #888;"><label for="'.$meta_box['name'].'">'.$meta_box['description'].'</label></p>';
    }
}

function save_form_data( $post_id ) {
    global $post, $palestra_details;
    
    foreach($palestra_details as $meta_box) {
        if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ) ) {
            return $post_id;
        }
        if ( 'page' ==  $_POST['post_type'] ) {
            if (  !current_user_can( 'edit_page', $post_id ))
                return  $post_id;
        } else {
            if (  !current_user_can( 'edit_post', $post_id ) )
                return  $post_id;
        }

        $data =  $_POST[$meta_box['name']];

        if(get_post_meta($post_id,  $meta_box['name']) == "")
            add_post_meta($post_id,  $meta_box['name'], $data, true);
        elseif($data !=  get_post_meta($post_id, $meta_box['name'], true))
            update_post_meta($post_id,  $meta_box['name'], $data);
        elseif($data ==  "")
            delete_post_meta($post_id,  $meta_box['name'], get_post_meta($post_id, $meta_box['name'], true));
    }
}


function create_meta_box() {
    global $theme_name,  $palestra_details;

    if (function_exists('add_meta_box')) {
        add_meta_box( 'my-custom-fields', 'Horário', 'generate_palestra_form', 'sities_palestra', 'normal', 'low' );
    }
}

# Desabilitado em favor do uso do plugin 'Custom Field Template'

# add_action('admin_menu',  'create_meta_box'); add_action('save_post',  'save_form_data');

?>