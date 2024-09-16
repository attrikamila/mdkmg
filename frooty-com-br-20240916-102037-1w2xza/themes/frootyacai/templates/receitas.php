<?php
$objPage = (object)acf_get_meta(7);
$objReceitaVoce = get_posts([
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
?>
<section class="receitas">
    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-9">
                <div class="row">
                    <div class="col-12 col-xl-5">
                        <h2><?= $objPage->titulo_receitas ?? ""; ?></h2>
                        <p><?= $objPage->texto_receitas ?? ""; ?></p>
                    </div>
                    <div class="col-12 col-xl-7 text-start text-xl-end">
                        <a href="<?= $objPage->cta_receitas["url"] ?? ""; ?>">
                            <button class="button frooty-outline"><?= $objPage->cta_receitas["title"] ?? ""; ?> <i class="fa-solid fa-chevron-right"></i></button>
                        </a>
                    </div>
                </div>
                <div class="row mt-5 mb-3">
                    <div class="col-12">
                        <ul>
                            <li id="foryou" class="active" data-tab="tab-voce"><a href="javascript:void(0)">Para Você</a></li>
                            <li id="forbusiness" class="" data-tab="tab-negocio"><a href="javascript:void(0)">Para Seu Negócio</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row tab active" id="tab-voce">
                    <?php foreach ($objReceitaVoce as $rk => $voce): ?>
                        <div class="col-12 col-md-6 col-lg-4 col-xl-4 mb-5 mb-xl-1">
                            <figure class="text-center">
                                <img class="img-fluid" src="<?= get_the_post_thumbnail_url($voce->ID) ?? ""; ?>" alt="<?= $voce->post_title ?? ""; ?>">
                                <figcaption>
                                    <h2 class="my-4"><?= $voce->post_title ?? ""; ?></h2>
                                    <a href="<?= get_site_url(); ?>/receitas/<?= $voce->post_name ?? ""; ?>">
                                        <button class="button frooty-outline">Experimentar <i class="fa-solid fa-chevron-right"></i></button>
                                    </a>
                                </figcaption>
                            </figure>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="row tab" id="tab-negocio">
                    <?php foreach ($objReceitaNegocio as $rk => $negocio): ?>
                        <div class="col-12 col-md-6 col-lg-4 col-xl-4 mb-5 mb-xl-1">
                            <figure class="text-center">
                                <img class="img-fluid" src="<?= get_the_post_thumbnail_url($negocio->ID) ?? ""; ?>" alt="<?= $negocio->post_title ?? ""; ?>">
                                <figcaption>
                                    <h2 class="my-4"><?= $negocio->post_title ?? ""; ?></h2>
                                    <a href="<?= get_site_url(); ?>/receitas/<?= $negocio->post_name ?? ""; ?>">
                                        <button class="button frooty-outline">Experimentar <i class="fa-solid fa-chevron-right"></i></button>
                                    </a>
                                </figcaption>
                            </figure>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-3 bg d-none d-xl-flex">
                <img src="<?= get_post($objPage->background_receitas)->guid ?? ""; ?>" class="img-fluid" alt="Imagem do açai para receitas">
            </div>
        </div>
    </div>
</section>