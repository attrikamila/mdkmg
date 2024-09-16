<?php
/*
Plugin Name: Attri Custom Post - Depoimentos
Description: Adiciona custom posts para depoimentos
Author: Attri
*/

function lc_custom_depoimentos() {

	// Set the labels, this variable is used in the $args array
	$labels = array(
		'name'               => __( 'Depoimentos' ),
		'singular_name'      => __( 'Depoimentos' ),
		'add_new'            => __( 'Adicionar' ),
		'add_new_item'       => __( 'Adicionar' ),
		'edit_item'          => __( 'Editar' ),
		'new_item'           => __( 'Novo depoimento' ),
		'all_items'          => __( 'Todos' ),
		'view_item'          => __( 'Visualizar' ),
		'search_items'       => __( 'Buscar' ),
		'featured_image'     => 'Poster',
		'set_featured_image' => 'Adicionar capa'
	);

	// The arguments for our post type, to be entered as parameter 2 of register_post_type()
	$args = array(
		'labels'            => $labels,
		'description'       => 'Custom posts para Depoimentos',
		'public'            => true,
		'menu_position'     => 9,
//		'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ),
		'supports'          => array( 'title', 'editor', 'thumbnail','custom-fields' ),
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'has_archive'       => true,
		'query_var'         => 'depoimentos',
		'menu_icon'         => 'dashicons-format-chat',
	);

	register_post_type( 'depoimentos', $args );
}
add_action( 'init', 'lc_custom_depoimentos' );
