<?php
/*
Plugin Name: Attri Custom Post - Códigos e Políticas
Description: Adiciona custom posts para códigos e políticas
Author: Attri
*/

function lc_custom_post_politicas() {

	// Set the labels, this variable is used in the $args array
	$labels = array(
		'name'               => __( 'Códigos e Políticas' ),
		'singular_name'      => __( 'Códigos e Políticas' ),
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
		'description'       => 'Custom posts para Códigos e políticas.',
		'public'            => true,
		'menu_position'     => 15,
//		'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ),
		'supports'          => array( 'title', 'editor','custom-fields' ),
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'has_archive'       => true,
		'query_var'         => 'politicas',
		'menu_icon'         => 'dashicons-welcome-view-site',
	);

	register_post_type( 'politicas', $args );
}
add_action( 'init', 'lc_custom_post_politicas' );
