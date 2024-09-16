<?php
include_once "templates/partials/header.php";
$objPage = (object)acf_get_meta(16);
// Obtém os termos da taxonomia com metadados ACF 'ordem'
$termosTipoProduto = get_terms(array(
    'taxonomy' => 'categoria__produtos',
    'hide_empty' => false,
    'meta_key' => 'ordem', // Chave de metadados do ACF
    'orderby' => 'meta_value_num', // Ordena os termos por valor numérico
    'order' => 'ASC' // Ordem ascendente
));

$objCategoriaProdutos = $termosTipoProduto;
//$objCategoriaProdutos = get_terms('categoria__produtos', array('hide_empty' => false, "order" => "asc"));
?>
<?php

// Suponha que você está trabalhando dentro do loop do seu custom post 'produto'.
$taxonomy = 'categoria__tamanho';

// Obtenha os termos da taxonomia com a ordenação personalizada.
$terms = get_terms(array(
    'taxonomy' => $taxonomy,
    'orderby' => 'meta_value_num', // Ordenar por valor numérico do campo personalizado.
    'meta_key' => 'ordem_exibicao', // Nome do campo personalizado ACF.
    'order' => 'ASC', // Ordem ascendente.
));

$ordered_terms = array(); // Array para armazenar os termos ordenados.

foreach ($terms as $term) {
    $ordered_terms[] = array(
        'term_id' => $term->term_id,
        'slug' => $term->slug,
        'name' => $term->name,
    );
}

// echo '<pre>';
// var_dump($termos);
// echo '</pre>';



?>

<main id="produtos" class="mb-5">

    <section id="title">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-start">
                    <h2><?= $objPage->titulo ?? ""; ?></h2>
                    <p><?= $objPage->subtitulo ?? ""; ?></p>
                </div>
            </div>
        </div>
    </section>

    <section class="categories d-none">
        <div class="container">
            <div class="bg-white rounded-5 py-5 py-lg-0">
                <div class="row justify-content-center h-100">
                    <div class="col-12 my-auto">
                        <div class="row justify-content-center justify-content-md-center">
                            <?php foreach ($objCategoriaProdutos as $k => $categoria) : ?>
                                <div class="col-4 col-md-4 col-lg-2 col-xl-2 my-4 my-xl-1">
                                    <figure class="text-center">
                                        <a href="#<?= $categoria->slug ?? ""; ?>">
                                            <img class="img-fluid" src="<?= get_field('icone', get_term($categoria))["url"]; ?>" alt="Imagem categoria Açai">
                                            <figcaption>
                                                <h2 class="text-center"><?= $categoria->name ?? ""; ?></h2>
                                                <button class="button small frooty-pitaya d-none d-xl-block" type="button">Conhecer <i class="fa-solid fa-chevron-right"></i></button>
                                            </figcaption>
                                        </a>
                                    </figure>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="categories">
        <div class="container">
            <div class="bg-white rounded-5 py-5 py-lg-0">
                <div class="row justify-content-center h-100">
                    <div class="col-12 col-xl-11 my-auto">
                        <div class="container-produtos py-4">
                            <?php foreach ($objCategoriaProdutos as $k => $categoria) : ?>
                                <div class="">
                                    <figure class="text-center">
                                        <a href="#<?= $categoria->slug ?? ""; ?>">
                                            <img class="img-fluid" src="<?= get_field('icone', get_term($categoria))["url"]; ?>" alt="Imagem categoria Açai">
                                            <figcaption>
                                                <h2 class="text-center"><?= $categoria->name ?? ""; ?></h2>
                                                <button class="button small frooty-pitaya d-none d-xl-block" type="button">Conhecer <i class="fa-solid fa-chevron-right"></i></button>
                                            </figcaption>
                                        </a>
                                    </figure>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="container-produtos" class="slider-produtos">
        <div class="container">
            <?php foreach ($objCategoriaProdutos as $k => $categoria) :
                //print_r($categoria);
            ?>

                <div class="row h-100 justify-content-center">
                    <div class="col-12 mt-5">
                        <h2 id="<?= $categoria->slug ?? ""; ?>" class="text-center" style="font-size: 1.25rem; color: #ED0973; font-weight: 800;"><?= $categoria->name ?? ""; ?></h2>
                    </div>

                    <?php foreach ($ordered_terms as $pk => $tamanho) : ?>
                        <?php
                        //print_r($tamanho);
                        $objProd = get_posts([
                            "post_type" => "produtos",
                            "post_status" => "publish",
                            "order_by" => "date",
                            "order" => "asc",
                            "posts_per_page" => "-1",
                            "tax_query" => [
                                'relation' => 'AND',
                                array(
                                    'taxonomy' => 'categoria__produtos',
                                    'field' => 'slug',
                                    'terms' => $categoria->slug,
                                    'compare' => "IN"
                                ),
                                array(
                                    'taxonomy' => 'categoria__tamanho',
                                    'field' => 'slug',
                                    'terms' => $tamanho["slug"],
                                    'compare' => "IN"
                                )
                            ]
                        ]);
                        // print_r($objProd);
                        ?>
                        <?php foreach ($objProd as $pk => $prod) :

                        ?>

                            <!-- <?php echo $prod->tamanho_imagem; ?> -->
                            <div class="col-6 col-md-4 col-xl-4 my-auto">
                                <figure class="text-center">
                                    <a href="<?= get_site_url(); ?>/produto/<?= $prod->post_name ?? ""; ?>">
                                        <img class="img-fluid" style="width: 
                                        <?php if (!empty($prod->tamanho_imagem)) : ?> <?php echo $prod->tamanho_imagem . "px"; ?> <?php endif; ?>" src="<?= get_the_post_thumbnail_url($prod->ID); ?>" alt="">
                                    </a>
                                    <figcaption class="pb-3">
                                        <a href="<?= get_site_url(); ?>/produto/<?= $prod->post_name ?? ""; ?>">
                                            <?= $prod->post_title ?? ""; ?>
                                        </a>
                                        <a href="<?= get_site_url(); ?>/produto/<?= $prod->post_name ?? ""; ?>">
                                            <h2 class="mt-2 conhecer">Conhecer <i class="fa-solid fa-chevron-right"></i></h2>
                                        </a>
                                    </figcaption>
                                </figure>
                            </div>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
            <div class="row h-100 justify-content-center my-5 py-5"></div>
        </div>
    </section>
</main>
<?php include_once "templates/partials/footer.php"; ?>