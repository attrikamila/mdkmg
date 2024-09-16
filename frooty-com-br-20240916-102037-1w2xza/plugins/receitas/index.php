<?php
/*
Plugin Name: Attri Custom Post - Receitas
Description: Adiciona custom posts para receitas
Author: Attri
*/

function lc_custom_post_receitas()
{

    // Set the labels, this variable is used in the $args array
    $labels = array(
        'name'               => __('Receitas'),
        'singular_name'      => __('Receita'),
        'add_new'            => __('Adicionar'),
        'add_new_item'       => __('Adicionar'),
        'edit_item'          => __('Editar'),
        'new_item'           => __('Nova receita'),
        'all_items'          => __('Todas'),
        'view_item'          => __('Visualizar'),
        'search_items'       => __('Buscar'),
        'featured_image'     => 'Poster',
        'set_featured_image' => 'Adicionar foto'
    );

    // The arguments for our post type, to be entered as parameter 2 of register_post_type()
    $args = array(
        'labels'            => $labels,
        'description'       => 'Custom posts para receitas',
        'public'            => true,
        'menu_position'     => 4,
        //		'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ),
        'supports'          => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'has_archive'       => true,
        'query_var'         => 'receitas',
        'menu_icon'         => 'dashicons-food
',
    );

    register_post_type('receitas', $args);

    register_taxonomy('categoria__receitas', ['receitas'], [
        'label' => __('Tipos de receita', 'txtdomain'),
        'hierarchical' => true,
        'rewrite' => ['slug' => 'tipo-receita'],
        'show_admin_column' => true,
        'show_in_rest' => true,
        'labels' => [
            'singular_name' => __('Tipo de receita', 'txtdomain'),
            'all_items' => __('Todos os Receitas', 'txtdomain'),
            'edit_item' => __('Editar Tipo de receita', 'txtdomain'),
            'view_item' => __('Ver Tipos de receita', 'txtdomain'),
            'update_item' => __('Atualizar Tipo de receita', 'txtdomain'),
            'add_new_item' => __('Adicionar Tipo de receita', 'txtdomain'),
            'new_item_name' => __('Novo Tipo de receita', 'txtdomain'),
            'search_items' => __('Buscar Tipo de receita', 'txtdomain'),
            'parent_item' => __('Parent Tipos de receita', 'txtdomain'),
            'parent_item_colon' => __('Parent Categorias:', 'txtdomain'),
            'not_found' => __('Nenhuma Tipo de receita encontrado', 'txtdomain'),
        ]
    ]);
    register_taxonomy_for_object_type('categoria__receitas', 'receitas');


//    register_taxonomy('categoria__ingrediente', ['ingredientes'], [
//        'label' => __('Ingrediente', 'txtdomain'),
//        'hierarchical' => true,
//        'rewrite' => ['slug' => 'ingrediente'],
//        'show_admin_column' => true,
//        'show_in_rest' => true,
//        'labels' => [
//            'singular_name' => __('Ingrediente', 'txtdomain'),
//            'all_items' => __('Todos os Ingredientes', 'txtdomain'),
//            'edit_item' => __('Editar Ingrediente', 'txtdomain'),
//            'view_item' => __('Ver Ingrediente', 'txtdomain'),
//            'update_item' => __('Atualizar Ingrediente', 'txtdomain'),
//            'add_new_item' => __('Adicionar Ingrediente', 'txtdomain'),
//            'new_item_name' => __('Novo Ingrediente', 'txtdomain'),
//            'search_items' => __('Buscar ingrediente', 'txtdomain'),
//            'parent_item' => __('Parent Ingredientes', 'txtdomain'),
//            'parent_item_colon' => __('Parent Categorias:', 'txtdomain'),
//            'not_found' => __('Nenhuma ingrediente encontrado', 'txtdomain'),
//        ]
//    ]);
//    register_taxonomy_for_object_type('categoria__ingrediente', 'receitas');



    register_taxonomy('categoria__dificuldade', ['dificuldades'], [
        'label' => __('Dificuldade', 'txtdomain'),
        'hierarchical' => true,
        'rewrite' => ['slug' => 'dificuldade'],
        'show_admin_column' => true,
        'show_in_rest' => true,
        'labels' => [
            'singular_name' => __('Dificuldade', 'txtdomain'),
            'all_items' => __('Todos os Dificuldades', 'txtdomain'),
            'edit_item' => __('Editar Dificuldade', 'txtdomain'),
            'view_item' => __('Ver Dificuldade', 'txtdomain'),
            'update_item' => __('Atualizar Dificuldade', 'txtdomain'),
            'add_new_item' => __('Adicionar Dificuldade', 'txtdomain'),
            'new_item_name' => __('Novo Dificuldade', 'txtdomain'),
            'search_items' => __('Buscar dificuldade', 'txtdomain'),
            'parent_item' => __('Parent Dificuldades', 'txtdomain'),
            'parent_item_colon' => __('Parent Categorias:', 'txtdomain'),
            'not_found' => __('Nenhuma dificuldade encontrado', 'txtdomain'),
        ]
    ]);
    register_taxonomy_for_object_type('categoria__dificuldade', 'receitas');
}
add_action('init', 'lc_custom_post_receitas');
