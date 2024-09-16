<?php
/*
Plugin Name: Attri Custom Post - Onde Estamos
Description: Adiciona custom posts para locais
Author: Attri
*/

function lc_custom_post_locais() {

    // Set the labels, this variable is used in the $args array
    $labels = array(
        'name'               => __( 'Onde Estamos' ),
        'singular_name'      => __( 'Onde Estamos' ),
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
        'description'       => 'Custom posts para locais',
        'public'            => true,
        'menu_position'     => 14,
//		'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ),
        'supports'          => array( 'title', 'editor', 'thumbnail','custom-fields' ),
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'has_archive'       => true,
        'query_var'         => 'locais',
        'menu_icon'         => 'dashicons-location-alt
',
    );

    register_post_type( 'locais', $args );

    register_taxonomy('locais', ['locais'], [
        'label' => __('Local', 'txtdomain'),
        'hierarchical' => true,
        'rewrite' => ['slug' => 'locais'],
        'show_admin_column' => true,
        'show_in_rest' => true,
        'labels' => [
            'singular_name' => __('Local', 'txtdomain'),
            'all_items' => __('Todos as Local', 'txtdomain'),
            'edit_item' => __('Editar Local', 'txtdomain'),
            'view_item' => __('Ver Local', 'txtdomain'),
            'update_item' => __('Atualizar local', 'txtdomain'),
            'add_new_item' => __('Adicionar local', 'txtdomain'),
            'new_item_name' => __('Novo Local', 'txtdomain'),
            'search_items' => __('Buscar Local', 'txtdomain'),
            'parent_item' => __('Parent Local', 'txtdomain'),
            'parent_item_colon' => __('Parent Local:', 'txtdomain'),
            'not_found' => __('Nenhuma localização encontrada', 'txtdomain'),
        ]
    ]);
    register_taxonomy_for_object_type('locais', 'locais');

    register_taxonomy('uf', ['locais'], [
        'label' => __('Estados', 'txtdomain'),
        'hierarchical' => true,
        'rewrite' => ['slug' => 'uf'],
        'show_admin_column' => true,
        'show_in_rest' => true,
        'labels' => [
            'singular_name' => __('Estados', 'txtdomain'),
            'all_items' => __('Todos os Estados', 'txtdomain'),
            'edit_item' => __('Editar Estado', 'txtdomain'),
            'view_item' => __('Ver Estado', 'txtdomain'),
            'update_item' => __('Atualizar Estado', 'txtdomain'),
            'add_new_item' => __('Adicionar Estado', 'txtdomain'),
            'new_item_name' => __('Novo Estado', 'txtdomain'),
            'search_items' => __('Buscar Estado', 'txtdomain'),
            'parent_item' => __('Parent Estado', 'txtdomain'),
            'parent_item_colon' => __('Parent Estado:', 'txtdomain'),
            'not_found' => __('Nenhum Estado encontrada', 'txtdomain'),
        ]
    ]);
    register_taxonomy_for_object_type('uf', 'uf');
}
add_action( 'init', 'lc_custom_post_locais' );
