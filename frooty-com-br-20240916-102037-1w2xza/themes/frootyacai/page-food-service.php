<?php
include_once "templates/partials/header.php";
$objPage = (object)acf_get_meta(26);
// echo count($objPage);
// $objCategoriaProdutos = get_terms('categoria__produtos', array('hide_empty' => false, "order" => "asc"));

// var_dump($objCategoriaProdutos);

// print_r($objCategoriaProdutos);
// echo "<pre>";
// print_r($objPage);


$objReceitaNegocio = get_posts([
    "post_type" => "receitas",
    "post_status" => "publish",
    "order" => "asc",
    "posts_per_page" => "3",
    "tax_query" => [
        'relation' => 'AND',
        array(
            'taxonomy' => 'categoria__receitas',
            'field' => 'slug',
            'terms' => ["para-sua-empresa"],
            'compare' => "IN"
        )
    ]
]);

$objPage2 = (object)acf_get_meta(7);
$objReceitaVoce2 = get_posts([
    "post_type" => "receitas",
    "post_status" => "publish",
    "order" => "asc",
    "posts_per_page" => "3",
    "tax_query" => [
        'relation' => 'AND',
        array(
            'taxonomy' => 'categoria__receitas',
            'field' => 'slug',
            'terms' => ["para-voce"],
            'compare' => "IN"
        )
    ]
]);
$objReceitaNegocio2 = get_posts([
    "post_type" => "receitas",
    "post_status" => "publish",
    "order" => "asc",
    "posts_per_page" => "3",
    "tax_query" => [
        'relation' => 'AND',
        array(
            'taxonomy' => 'categoria__receitas',
            'field' => 'slug',
            'terms' => ["para-sua-empresa"],
            'compare' => "IN"
        )
    ]
]);

?>

<main id="food-service" style="background-image: url('<?= get_post($objPage->imagem_banner)->guid ?? "" ?>')!important;">
    <section id="title">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-12 col-xl-7">
                    <h2><?= $objPage->titulo ?? "" ?></h2>
                    <p><?= $objPage->texto ?? "" ?></p>
                </div>
            </div>
        </div>
    </section>

    <section id="mais-frooty">
        <div class="container">
            <div class="row">
                <div class="col-12 my-5">
                    <h2 class="text-center title" style="font-size: 1.25rem; color: #ED0973; font-weight: 800;">Mais Frooty Para o Seu Negócio:</h2>
                </div>
            </div>

            <div class="row justify-content-center h-100">
                <div class="col-11 h-100">
                    <div class="row h-100">
                        <div class="my-auto w-100" id="slide-produtos-home">
                            <?php foreach ($objPage->produtos as $pk => $id) : ?>
                                <?php

                                var_dump($objPage->produtos);
                                    // echo "<pre>";
                                    // print_r();
                                    $prod = get_post($id);
                                ?>
                                <div class="col-3 my-auto">
                                    <figure class="text-center">
                                        <a href="<?= get_site_url() ?>/produto/<?= $prod->post_name ?? ""; ?>" class="text-white">
                                            <img class="img-fluid px-0 px-xl-5" src="<?= get_the_post_thumbnail_url($prod->ID) ?? ""; ?>" alt="">
                                        </a>
                                        <figcaption class="text-center">
                                            <a href="<?= get_site_url() ?>/produto/<?= $prod->post_name ?? ""; ?>" class="text-white">
                                                <h2 class="mt-2" style="color: var(--paragraph-color); font-weight: 800; font-size: var(--titles);"><?= $prod->post_title ?? ""; ?></h2>
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

    <?php include_once "templates/depoimentos.php" ?>

    <section id="sobre-frooty">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-10">
                    <div class="row m-0 p-0">
                        <div class="col-12 col-xl-9">
                            <h2><?= $objPage->titulo_sobre_a_frooty ?? ""; ?></h2>
                            <p>
                                <?= nl2br($objPage->texto_sobre_a_frooty) ?? ""; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="video">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-10">
                    <video width="100%" poster="<?= get_template_directory_uri(); ?>/assets/img/poster-video-sustentabilidade.png" controls>
                        <source src="<?= get_post($objPage->video_sobre_a_frooty)->guid ?? ""; ?>" type="video/mp4">
                    </video>
                </div>
            </div>
            <div class="row my-5 py-5"></div>
        </div>
    </section>


</main>
<?php include_once "templates/partials/footer.php"; ?>

<!-- <script src="">
    jQuery(function($) {
        $("#foryou").removeClass("active");
        $("#foryou").hide();
        $("#forbusiness").addClass("active")
    });
</script> -->
