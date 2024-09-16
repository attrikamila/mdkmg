<?php
include_once "templates/partials/header.php";
$objReceita = get_queried_object();
$objReceita->meta = (object)acf_get_meta($objReceita->ID);
$objReceita->dificuldade = get_the_terms($objReceita->ID, 'categoria__dificuldade')[0];
?>
    <main id="receita" class="mb-5">
        <section id="title">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 text-center">
                        <h2><?= $objReceita->post_title ?? ""; ?></h2>
                    </div>
                    <!-- <div class="col-6 text-end pe-4">
                        <img src="<?= get_template_directory_uri(); ?>/assets/img/icon-spoon.png" alt=""> <span><?= $objReceita->dificuldade->name ?? "Não informado"; ?></span>
                    </div>
                    <div class="col-6 text-start ps-4">
                        <img src="<?= get_template_directory_uri(); ?>/assets/img/icon%20_time_history_.png" alt=""> <span><?= $objReceita->meta->tempo_de_preparo ?? "Não informado"; ?> min</span>
                    </div> -->
                </div>
            </div>
        </section>

        <section id="content" class="pb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-10 mb-5">
                        <img src="<?= get_post($objReceita->meta->imagem)->guid ?? ""; ?>" class="img-fluid img-destaque" alt="">
                    </div>
                </div>

                <div class="row justify-content-center my-5">
                    <div class="col-12 col-xl-5">
                        <h3>Ingredientes</h3>

                        <?php for ($i = 0; $i < $objReceita->meta->etapa; $i++): ?>
                            <strong><?= $objReceita->{"etapa_" . $i . "_titulo_da_etapa"} ?? ""; ?> </strong>
                            <ol>
                                <?php for ($z = 0; $z < $objReceita->meta->{"etapa_" . $i . "_ingredientes"}; $z++): ?>
                                    <li><?= $objReceita->meta->{"etapa_" . $i . "_ingredientes_" . $z . "_ingrediente_item"} ?? ""; ?></li>
                                <?php endfor; ?>
                            </ol>
                        <?php endfor; ?>
                    </div>

                    <div class="col-12 col-xl-5 tips mt-4 mt-xl-0">
                        <?php if (!empty($objReceita->meta->produtos)): ?>
                            <h3>Quer uma dica?</h3>
                            <p><?= $objReceita->meta->titulo_dica ?? ""; ?></p>
                            <ul>
                                <?php foreach ($objReceita->meta->produtos as $pk => $id): ?>
                                    <?php $prod = get_post($id); ?>
                                    <li>
                                        <a href="<?= get_site_url(); ?>/produto/<?= $prod->post_name ?? ""; ?>">
                                            <img src="<?= get_the_post_thumbnail_url($id) ?>" class="img-fluid" alt="">
                                            <span class="ps-2"><?= $prod->post_title ?? ""; ?></span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <section id="modo-preparo">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-8">
                        <h2 class="mb-5">Modo de preparo</h2>

                        <?php for ($i = 0; $i < $objReceita->meta->etapa_modo_preparo; $i++): ?>
                            <h3><?= $objReceita->{"etapa_" . $i . "_titulo_da_etapa"} ?? ""; ?> </h3>
                            <ol>
                                <?php for ($z = 0; $z < $objReceita->meta->{"etapa_modo_preparo_" . $i . "_descricao"}; $z++): ?>
                                    <li><?= $objReceita->meta->{"etapa_modo_preparo_" . $i . "_descricao_" . $z . "_descricao"} ?? ""; ?></li>
                                <?php endfor; ?>
                            </ol>
                        <?php endfor; ?>

                    </div>
                </div>
            </div>
        </section>

        <?php if (!empty($objReceita->meta->dica_frooty)): ?>
            <section id="dica-frooty">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-xl-8">
                            <div class="row m-0 p-0 bg h-100">
                                <div class="col-12 col-xl-3 my-auto text-center">
                                    <img src="<?= get_template_directory_uri(); ?>/assets/img/icon%20_Idea_.png" class="img-fluid" alt="">
                                </div>
                                <div class="col-12 col-xl-9 my-auto">
                                    <h2 class="mt-4 pt-4 mt-xl-0">Dica Frooty</h2>
                                    <p><?= nl2br($objReceita->dica_frooty) ?? ""; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php include_once "templates/sabor-que-nutre.php"; ?>

        <?php include_once "templates/receitas.php"; ?>

        <div class="container">
            <div class="row my-5 py-5"></div>
        </div>

        <!--        <section class="receitas">-->
        <!--            <div class="container">-->
        <!--                <div class="row justify-content-center">-->
        <!--                    <div class="col-12 col-xl-10">-->
        <!--                        <div class="row">-->
        <!--                            <div class="col-12 col-xl-4">-->
        <!--                                <h2>Receitas</h2>-->
        <!--                                <p>Descubra a versatilidade de Frooty com receitas deliciosas e fáceis de fazer.</p>-->
        <!--                            </div>-->
        <!--                            <div class="col-12 col-xl-8 text-start text-xl-end">-->
        <!--                                <a href="">-->
        <!--                                    <button class="button frooty-outline">Ver todas <i class="fa-solid fa-chevron-right"></i></button>-->
        <!--                                </a>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                        <div class="row mt-5 mb-3">-->
        <!--                            <div class="col-12">-->
        <!--                                <ul>-->
        <!--                                    <li class="active" data-tab="tab-voce"><a href="javascript:void(0)">Para você</a></li>-->
        <!--                                    <li class="" data-tab="tab-negocio"><a href="javascript:void(0)">Para seu Negócio</a></li>-->
        <!--                                </ul>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                        <div class="row tab active" id="tab-voce">-->
        <!--                            <div class="col-12 col-md-6 col-lg-3 col-xl-3 mb-5 mb-xl-1">-->
        <!--                                <figure class="text-center">-->
        <!--                                    <img class="img-fluid" src="--><? //= get_template_directory_uri(); ?><!--/--><? //= get_template_directory_uri(); ?><!--/assets/img/receita-1.png" alt="Calda de Pitaya para Sorvete">-->
        <!--                                    <figcaption>-->
        <!--                                        <h2 class="my-4">Calda de Pitaya para Sorvete</h2>-->
        <!--                                        <button class="button frooty-outline">Experimentar <i class="fa-solid fa-chevron-right"></i></button>-->
        <!--                                    </figcaption>-->
        <!--                                </figure>-->
        <!--                            </div>-->
        <!--                            <div class="col-12 col-md-6 col-lg-3 col-xl-3 mb-5 mb-xl-1">-->
        <!--                                <figure class="text-center">-->
        <!--                                    <img class="img-fluid" src="--><? //= get_template_directory_uri(); ?><!--/--><? //= get_template_directory_uri(); ?><!--/assets/img/receita-2.png" alt="Gin Float de Pitaya">-->
        <!--                                    <figcaption>-->
        <!--                                        <h2 class="my-4">Gin Float de Pitaya</h2>-->
        <!--                                        <button class="button frooty-outline">Experimentar <i class="fa-solid fa-chevron-right"></i></button>-->
        <!--                                    </figcaption>-->
        <!--                                </figure>-->
        <!--                            </div>-->
        <!--                            <div class="col-12 col-md-6 col-lg-3 col-xl-3 mb-5 mb-xl-1">-->
        <!--                                <figure class="text-center">-->
        <!--                                    <img class="img-fluid" src="--><? //= get_template_directory_uri(); ?><!--/--><? //= get_template_directory_uri(); ?><!--/assets/img/receita-3.png" alt="Cupuaçu Colada (sem álcool)">-->
        <!--                                    <figcaption>-->
        <!--                                        <h2 class="my-4">Cupuaçu Colada (sem álcool)</h2>-->
        <!--                                        <button class="button frooty-outline">Experimentar <i class="fa-solid fa-chevron-right"></i></button>-->
        <!--                                    </figcaption>-->
        <!--                                </figure>-->
        <!--                            </div>-->
        <!--                            <div class="col-12 col-md-6 col-lg-3 col-xl-3 mb-5 mb-xl-1">-->
        <!--                                <figure class="text-center">-->
        <!--                                    <img class="img-fluid" src="--><? //= get_template_directory_uri(); ?><!--/--><? //= get_template_directory_uri(); ?><!--/assets/img/receita-1.png" alt="Calda de Pitaya para Sorvete">-->
        <!--                                    <figcaption>-->
        <!--                                        <h2 class="my-4">Calda de Pitaya para Sorvete</h2>-->
        <!--                                        <button class="button frooty-outline">Experimentar <i class="fa-solid fa-chevron-right"></i></button>-->
        <!--                                    </figcaption>-->
        <!--                                </figure>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                        <div class="row tab" id="tab-negocio">-->
        <!--                            <div class="col-12 col-md-6 col-lg-3 col-xl-3 mb-5 mb-xl-1">-->
        <!--                                <figure class="text-center">-->
        <!--                                    <img class="img-fluid" src="--><? //= get_template_directory_uri(); ?><!--/--><? //= get_template_directory_uri(); ?><!--/assets/img/receita-3.png" alt="Cupuaçu Colada (sem álcool)">-->
        <!--                                    <figcaption>-->
        <!--                                        <h2 class="my-4">Cupuaçu Colada (sem álcool)</h2>-->
        <!--                                        <button class="button frooty-outline">Experimentar <i class="fa-solid fa-chevron-right"></i></button>-->
        <!--                                    </figcaption>-->
        <!--                                </figure>-->
        <!--                            </div>-->
        <!--                            <div class="col-12 col-md-6 col-lg-3 col-xl-3 mb-5 mb-xl-1">-->
        <!--                                <figure class="text-center">-->
        <!--                                    <img class="img-fluid" src="--><? //= get_template_directory_uri(); ?><!--/--><? //= get_template_directory_uri(); ?><!--/assets/img/receita-1.png" alt="Calda de Pitaya para Sorvete">-->
        <!--                                    <figcaption>-->
        <!--                                        <h2 class="my-4">Calda de Pitaya para Sorvete</h2>-->
        <!--                                        <button class="button frooty-outline">Experimentar <i class="fa-solid fa-chevron-right"></i></button>-->
        <!--                                    </figcaption>-->
        <!--                                </figure>-->
        <!--                            </div>-->
        <!--                            <div class="col-12 col-md-6 col-lg-3 col-xl-3 mb-5 mb-xl-1">-->
        <!--                                <figure class="text-center">-->
        <!--                                    <img class="img-fluid" src="--><? //= get_template_directory_uri(); ?><!--/--><? //= get_template_directory_uri(); ?><!--/assets/img/receita-2.png" alt="Gin Float de Pitaya">-->
        <!--                                    <figcaption>-->
        <!--                                        <h2 class="my-4">Gin Float de Pitaya</h2>-->
        <!--                                        <button class="button frooty-outline">Experimentar <i class="fa-solid fa-chevron-right"></i></button>-->
        <!--                                    </figcaption>-->
        <!--                                </figure>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                <div class="row my-5 py-5"></div>-->
        <!--            </div>-->
        <!--        </section>-->

    </main>
<?php include_once "templates/partials/footer.php"; ?>