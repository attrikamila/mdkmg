<?php
/*
Plugin Name: Attri Custom Post - Certificações
Description: Adiciona custom posts para certificacoes
Author: Attri
*/

function lc_custom_certificacoes() {

	// Set the labels, this variable is used in the $args array
	$labels = array(
		'name'               => __( 'Certificações' ),
		'singular_name'      => __( 'Certificações' ),
		'add_new'            => __( 'Adicionar' ),
		'add_new_item'       => __( 'Adicionar' ),
		'edit_item'          => __( 'Editar' ),
		'new_item'           => __( 'Nova certificacao' ),
		'all_items'          => __( 'Todas' ),
		'view_item'          => __( 'Visualizar' ),
		'search_items'       => __( 'Buscar' ),
		'featured_image'     => 'Poster',
		'set_featured_image' => 'Adicionar capa'
	);

	// The arguments for our post type, to be entered as parameter 2 of register_post_type()
	$args = array(
		'labels'            => $labels,
		'description'       => 'Custom posts para Certificações',
		'public'            => true,
		'menu_position'     => 12,
//		'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ),
		'supports'          => array( 'title', 'editor', 'thumbnail','custom-fields' ),
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'has_archive'       => true,
		'query_var'         => 'certificacoes',
		'menu_icon'         => 'dashicons-awards',
	);

	register_post_type( 'certificacoes', $args );
}
add_action( 'init', 'lc_custom_certificacoes' );
