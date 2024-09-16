<?php
/*
Plugin Name: Attri Custom Post - Produtos
Description: Adiciona custom posts para produtos
Author: Attri
*/

function lc_custom_post_produtos()
{

    // Set the labels, this variable is used in the $args array
    $labels = array(
        'name'               => __('Produtos'),
        'singular_name'      => __('Produto'),
        'add_new'            => __('Adicionar'),
        'add_new_item'       => __('Adicionar'),
        'edit_item'          => __('Editar'),
        'new_item'           => __('Novo produto'),
        'all_items'          => __('Todos'),
        'view_item'          => __('Visualizar'),
        'search_items'       => __('Buscar'),
        'featured_image'     => 'Poster',
        'set_featured_image' => 'Adicionar foto'
    );

    // The arguments for our post type, to be entered as parameter 2 of register_post_type()
    $args = array(
        'labels'            => $labels,
        'description'       => 'Custom posts para produtos',
        'public'            => true,
        'menu_position'     => 4,
        //		'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ),
        'supports'          => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'has_archive'       => true,
        'query_var'         => 'produtos',
        'menu_icon'         => 'dashicons-editor-ul',
        'rewrite' => [
            'slug' => (!empty(get_option('mytheme_reference_slug'))) ? get_option('mytheme_reference_slug') : 'produto',
            'with_front' => false
        ]
    );

    register_post_type('produtos', $args);

    register_taxonomy('categoria__produtos', ['produtos'], [
        'label' => __('Tipos de produto', 'txtdomain'),
        'hierarchical' => true,
        'rewrite' => ['slug' => 'linha-produto'],
        'show_admin_column' => true,
        'show_in_rest' => true,
        'labels' => [
            'singular_name' => __('Tipo de produto', 'txtdomain'),
            'all_items' => __('Todos os Produtos', 'txtdomain'),
            'edit_item' => __('Editar Tipo de produto', 'txtdomain'),
            'view_item' => __('Ver Tipos de produto', 'txtdomain'),
            'update_item' => __('Atualizar Tipo de produto', 'txtdomain'),
            'add_new_item' => __('Adicionar Tipo de produto', 'txtdomain'),
            'new_item_name' => __('Novo Tipo de produto', 'txtdomain'),
            'search_items' => __('Buscar Tipo de produto', 'txtdomain'),
            'parent_item' => __('Parent Tipos de produto', 'txtdomain'),
            'parent_item_colon' => __('Parent Categorias:', 'txtdomain'),
            'not_found' => __('Nenhuma Tipo de produto encontrado', 'txtdomain'),
        ]
    ]);
    register_taxonomy_for_object_type('categoria__produtos', 'produtos');

    register_taxonomy('categoria__tamanho', ['tamanhos'], [
        'label' => __('Tamanho', 'txtdomain'),
        'hierarchical' => true,
        'rewrite' => ['slug' => 'tamanho'],
        'show_admin_column' => true,
        'show_in_rest' => true,
        'labels' => [
            'singular_name' => __('Tamanho', 'txtdomain'),
            'all_items' => __('Todos os Tamanhos', 'txtdomain'),
            'edit_item' => __('Editar Tamanho', 'txtdomain'),
            'view_item' => __('Ver Tamanho', 'txtdomain'),
            'update_item' => __('Atualizar Tamanho', 'txtdomain'),
            'add_new_item' => __('Adicionar Tamanho', 'txtdomain'),
            'new_item_name' => __('Novo Tamanho', 'txtdomain'),
            'search_items' => __('Buscar tamanho', 'txtdomain'),
            'parent_item' => __('Parent Tamanhos', 'txtdomain'),
            'parent_item_colon' => __('Parent Categorias:', 'txtdomain'),
            'not_found' => __('Nenhuma tamanho encontrado', 'txtdomain'),
        ]
    ]);
    register_taxonomy_for_object_type('categoria__tamanho', 'produtos');



    register_taxonomy('categoria__ingrediente_produto', ['ingredientes'], [
        'label' => __('Ingrediente', 'txtdomain'),
        'hierarchical' => true,
        'rewrite' => ['slug' => 'ingrediente-do-produto'],
        'show_admin_column' => true,
        'show_in_rest' => true,
        'labels' => [
            'singular_name' => __('Ingrediente do produto', 'txtdomain'),
            'all_items' => __('Todos os Ingredientes', 'txtdomain'),
            'edit_item' => __('Editar Ingrediente', 'txtdomain'),
            'view_item' => __('Ver Ingrediente', 'txtdomain'),
            'update_item' => __('Atualizar Ingrediente', 'txtdomain'),
            'add_new_item' => __('Adicionar Ingrediente', 'txtdomain'),
            'new_item_name' => __('Novo Ingrediente', 'txtdomain'),
            'search_items' => __('Buscar ingrediente', 'txtdomain'),
            'parent_item' => __('Parent Ingredientes', 'txtdomain'),
            'parent_item_colon' => __('Parent Categorias:', 'txtdomain'),
            'not_found' => __('Nenhuma ingrediente encontrado', 'txtdomain'),
        ]
    ]);
    register_taxonomy_for_object_type('categoria__ingrediente_produto', 'produtos');
}

// Reescreve a rota padrão do slug
add_action('admin_init', function() {
    add_settings_field('mytheme_reference_slug', __('Produto Single Base', 'txtdomain'), 'mytest_reference_slug_output', 'permalink', 'optional');
});
function mytest_reference_slug_output() {
    ?>
    <input name="mytheme_reference_slug" type="text" class="regular-text code" value="<?php echo esc_attr(get_option('mytheme_reference_slug')); ?>" placeholder="<?php echo 'reference'; ?>" />
    <?php
}
add_action('admin_init', function() {
    if (isset($_POST['permalink_structure'])) {
        update_option('mytheme_reference_slug', trim($_POST['mytheme_reference_slug']));
    }
});
add_action('init', 'lc_custom_post_produtos');
