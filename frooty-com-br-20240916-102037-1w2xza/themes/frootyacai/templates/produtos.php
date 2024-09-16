<?php
$objProd = get_queried_object();
$objProd->meta = (object)acf_get_meta($objProd->ID);
$objProd->ingredientes = get_the_terms($objProd->ID, 'categoria__ingrediente_produto');
$objProds = get_posts([
    "post_type" => "produtos",
    "post_status" => "publish",
    "order" => "asc",
    "posts_per_page" => "15"
]);
shuffle($objProds);

?>

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
                        <?php foreach ($objProds as $pk => $prod) : ?>
                            <?php if (
                                $prod->post_title != "Frooty Açaí 2l" &&
                                $prod->post_title != "Frooty Açaí + Morango 2l" &&
                                $prod->post_title != "Frooty Açaí + Banana 2l" &&
                                $prod->post_title != "Frooty Açaí com Granola 200ml" &&
                                $prod->post_title != "Frooty Açaí + Banana 200ml com Granola" &&
                                $prod->post_title != "Frooty Açaí + Morango 200ml com Granola"
                            ) : ?>
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
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>