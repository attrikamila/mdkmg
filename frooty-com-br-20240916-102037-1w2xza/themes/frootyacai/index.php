<?php
include_once "templates/partials/header.php";
// include_once "templates/modal.php";
$objPage = (object)acf_get_meta(7);
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
$termBusca = 'acai';
$objProdAcai = get_posts([
    "post_type" => "produtos",
    "post_status" => "publish",
    "tax_query" => [
        'relation' => 'AND',
        array(
            'taxonomy' => 'categoria__produtos',
            'field' => 'slug',
            'terms' => $termBusca,
            'compare' => "IN"
        )
        ],
        "order" => "ASC",
        // "posts_per_page" => '-1',
]);



?>

    <main id="home">
        <section id="carousel-principal">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <?php for ($i = 0; $i < $objPage->informacoes_do_banner; $i++): ?>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $i == 0 ? "active" : "" ?>" class="active" aria-current="true" aria-label="Slide <?= $i; ?>"></button>
                    <?php endfor; ?>
                </div>
                <div class="carousel-inner">
                    <?php for ($i = 0; $i < $objPage->informacoes_do_banner; $i++): ?>
                        <div class="carousel-item <?= $i == 0 ? "active" : "" ?>" style="background-image: url('<?= get_post($objPage->fundo_do_banner)->guid ?? ""; ?>')">
                            <div class="container">
                                <div class="row h-100 justify-content-center">
                                    <div class="col-12 col-xl-11">
                                        <div class="row h-100 content">
                                            <div class="col-12 col-xl-5 my-auto">
                                                <h2 class="text-start"><?= $objPage->{"informacoes_do_banner_" . $i . "_titulo"} ?? ""; ?></h2>
                                                <a href="<?= $objPage->{"informacoes_do_banner_" . $i . "_cta"}["url"] ?? ""; ?>" target="<?= $objPage->{"informacoes_do_banner_" . $i . "_cta"}["target"] ?? ""; ?>">
                                                    <button type="button" class="button frooty-roxo mt-5 mb-5 mb-xl-0 mx-auto mx-lg-0 mx-xl-0 d-block">
                                                        <span><?= $objPage->{"informacoes_do_banner_" . $i . "_cta"}["title"] ?? ""; ?></span> <i class="fa-solid fa-chevron-right"></i>
                                                    </button>
                                                </a>
                                            </div>
                                            <div class="col-12 col-xl-7 my-auto text-end">
                                                <img class="img-fluid" src="<?= get_post($objPage->{"informacoes_do_banner_" . $i . "_imagem_destaque"})->guid ?? ""; ?>" alt="Imagem do produto Frooty Açai">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </section>

        <section class="container-content-2">
            <div class="container">
                <div class="row h-100 justify-content-center">
                    <div class="col-12 col-xl-11">
                        <div class="row h-100 justify-content-between content">
                            <?php for ($i = 0; $i < $objPage->descricao; $i++): ?>
                                <div class="col-12 col-md-4 col-xl-3 mb-5 mb-xl-1">
                                    <figure>
                                        <img class="img-fluid" src="<?= get_post($objPage->{"descricao_" . $i . "_icone"})->guid ?? ""; ?>" alt="">
                                        <figcaption>
                                            <h2 class="my-2 pt-2"><?= $objPage->{"descricao_" . $i . "_titulo"} ?? ""; ?></h2>
                                            <p><?= $objPage->{"descricao_" . $i . "_descricao"} ?? ""; ?></p>
                                            <a href="<?= $objPage->{"descricao_" . $i . "_link_para_ver_mais"}["url"] ?? ""; ?>" class="mt-5" target="<?= $objPage->{"descricao_" . $i . "_link_para_ver_mais"}["target"] ?? ""; ?>">
                                                <u><?= $objPage->{"descricao_" . $i . "_link_para_ver_mais"}["title"] ?? ""; ?></u>
                                            </a>
                                        </figcaption>
                                    </figure>
                                </div>
                            <?php endfor; ?>
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
                                <?php foreach ($objCategoriaProdutos as $k => $categoria): ?>
                                    <div class="">
                                        <figure class="text-center">
                                            <a href="<?= get_site_url(); ?>/linha-produto?<?= $categoria->slug ?? ""; ?>">
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

        <section class="slider-produtos" style="background-image: url('<?= get_template_directory_uri(); ?>/assets/img/bg-slider-produtos.jpg');">
            <div class="container h-100">
                <div class="row justify-content-center h-100">
                    <div class="col-11 h-100">
                        <div class="row h-100">
                            <div class="my-auto w-100" id="slide-produtos-home">
                                <?php foreach ($objProdAcai as $ak => $acai): ?>
                                    <div class="col-3 my-auto">
                                        <figure class="text-center">
                                            <img class="img-fluid" src="<?= get_the_post_thumbnail_url($acai->ID); ?>" alt="">
                                            <figcaption class="text-center">
                                                <a href="<?= get_site_url(); ?>/produto/<?= $acai->post_name ?? ""; ?>" class="text-white">
                                                    <h2 class="mt-2"><?= $acai->post_title ?? ""; ?></h2>
                                                </a>
                                                <a href="<?= get_site_url(); ?>/produto/<?= $acai->post_name ?? ""; ?>">
                                                    <h2 class="mt-5 conhecer">Conhecer <i class="fa-solid fa-chevron-right"></i></h2>
                                                </a>
                                            </figcaption>
                                        </figure>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php include_once "templates/receitas.php"; ?>

        <?php include_once "templates/depoimentos.php"; ?>

        <section class="food-service" style="background-image: url('<?= get_post($objPage->background)->guid ?? ""; ?>');">
            <div class="container h-100">
                <div class="row justify-content-center h-100">
                    <div class="col-12 col-xl-10 h-100 my-auto">
                        <div class="row container-service">
                            <div class="col-12 col-lg-6 col-xl-6">
                                <h2><?= $objPage->titulo ?? ""; ?></h2>
                                <p class="py-4">
                                    <?= nl2br($objPage->texto) ?? ""; ?>
                                </p>
                                <div class="mt-4">
                                    <a href="<?= $objPage->cta["url"] ?? ""; ?>" target="<?= $objPage->cta["target"] ?? ""; ?>">
                                        <button class="button frooty-roxo pitaya mx-auto mx-lg-0 mx-xl-0 d-block"><?= $objPage->cta["title"] ?? ""; ?> <i class="fa-solid fa-chevron-right"></i></button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php include_once "templates/partials/footer.php"; ?>