<?php
/*
Plugin Name: Attri Custom Post - Redes Sociais
Description: Adiciona custom posts para redes sociais
Author: Attri
*/

function lc_custom_post_social() {

	// Set the labels, this variable is used in the $args array
	$labels = array(
		'name'               => __( 'Redes Sociais' ),
		'singular_name'      => __( 'Redes Sociais' ),
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
		'description'       => 'Custom posts para Vídeos',
		'public'            => true,
		'menu_position'     => 4,
//		'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ),
		'supports'          => array( 'title', 'editor', 'thumbnail','custom-fields' ),
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'has_archive'       => true,
		'query_var'         => 'social',
		'menu_icon'         => 'dashicons-share',
	);

	register_post_type( 'social', $args );
}
add_action( 'init', 'lc_custom_post_social' );
