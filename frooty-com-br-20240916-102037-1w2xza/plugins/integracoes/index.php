<?php
/*
Plugin Name: Attri Custom Post - Integrações
Description: Adiciona custom posts para redes sociais
Author: Attri
*/

function lc_custom_post_integracoes() {

	// Set the labels, this variable is used in the $args array
	$labels = array(
		'name'               => __( 'Integrações' ),
		'singular_name'      => __( 'Integrações' ),
		'add_new'            => __( 'Adicionar' ),
		'add_new_item'       => __( 'Adicionar' ),
		'edit_item'          => __( 'Editar' ),
		'new_item'           => __( 'Novo registro' ),
		'all_items'          => __( 'Todos' ),
		'view_item'          => __( 'Visualizar' ),
		'search_items'       => __( 'Buscar' ),
		'featured_image'     => 'Poster',
		'set_featured_image' => 'Adicionar capa'
	);

	// The arguments for our post type, to be entered as parameter 2 of register_post_type()
	$args = array(
		'labels'            => $labels,
		'description'       => 'Custom posts para Integrações',
		'public'            => true,
		'menu_position'     => 14,
//		'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ),
		'supports'          => array( 'title','custom-fields' ),
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'has_archive'       => true,
		'query_var'         => 'integracoes',
		'menu_icon'         => 'dashicons-networking',
	);

	register_post_type( 'integracoes', $args );

    register_taxonomy('categoria_integracoes', ['integracoes'], [
        'label' => __('Locais de incorporação', 'txtdomain'),
        'hierarchical' => true,
        'show_admin_column' => true,
        'rewrite' => ['slug' => 'tipo-integracoes'],
        'show_in_rest' => true,
        'labels' => [
            'singular_name' => __('Tipo de integrações', 'txtdomain'),
            'all_items' => __('Todas as integrações', 'txtdomain'),
            'edit_item' => __('Editar integrações', 'txtdomain'),
            'view_item' => __('Ver integrações', 'txtdomain'),
            'update_item' => __('Atualizar integrações', 'txtdomain'),
            'add_new_item' => __('Adicionar integrações', 'txtdomain'),
            'new_item_name' => __('Nova integrações', 'txtdomain'),
            'search_items' => __('Buscar integrações', 'txtdomain'),
            'parent_item' => __('Parent integrações', 'txtdomain'),
            'parent_item_colon' => __('Parent integrações:', 'txtdomain'),
            'not_found' => __('Nenhuma integrações encontrado', 'txtdomain'),
        ]
    ]);
    register_taxonomy_for_object_type('categoria_integracoes', 'integracoes');

}
add_action( 'init', 'lc_custom_post_integracoes' );
