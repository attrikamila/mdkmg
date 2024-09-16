<?php
include_once "templates/partials/header.php";
$objPage = (object)acf_get_meta(10);
$objCertificacoes = get_posts([
    "post_type" => "certificacoes",
    "post_status" => "publish",
    "order" => "asc",
    "posts_per_page" => "-1"
]);

$objChamadas = (object)acf_get_meta(431);
?>
    <main id="sobre">
        <section id="carousel-principal">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" style="background-image: url('<?= get_post($objPage->background)->guid; ?>')">
                        <div class="container">
                            <div class="row h-100">
                                <div class="col-12">
                                    <div class="row h-100 content justify-content-end">
                                        <div class="col-12 col-xl-6 my-auto text text-center text-lg-end align-content-end">
                                            <h2 class="text-center text-md-end text-xl-center"><span><?= $objPage->titulo ?? ""; ?></span> <br> <?= $objPage->subtitulo ?? ""; ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="manifesto">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-10">
                        <div class="row m-0 p-0 justify-content-between h-100 position-relative">
                            <div class="col-12 col-md-5 col-xl-5 my-auto">
                                <img src="<?= get_post($objPage->imagem_manifesto)->guid ?? ""; ?>" class="img-fluid" alt="Manifesto">
                            </div>
                            <div class="col-12 col-md-6 col-xl-6 my-auto absolute px-4 pt-3 pt-xl-0 px-md-0 px-xl-0">
                                <h2><?= $objPage->titulo_manifesto ?? ""; ?></h2>
                                <p> <?= nl2br($objPage->texto_manifesto) ?? ""; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="visao">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-10">
                        <div class="row m-0 p-0 justify-content-between h-100">
                            <?php for ($i = 0; $i < $objPage->descricao_ideologicas; $i++): ?>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <figure class="<?= $i % 2 !== 0 ? "bg" : "" ?> p-3 p-xl-5">
                                        <div class="px-1 px-xl-4">
                                            <img src="<?= get_post($objPage->{"descricao_ideologicas_" . $i . "_icone"})->guid ?? ""; ?>" alt="<?= $objPage->{"descricao_ideologicas_" . $i . "_titulo"}; ?>" class="img-fluid">
                                            <figcaption>
                                                <h2 class="py-4"><?= $objPage->{"descricao_ideologicas_" . $i . "_titulo"} ?? ""; ?></h2>
                                                <p class="pt-3">
                                                    <?= nl2br($objPage->{"descricao_ideologicas_" . $i . "_descricao"}) ?? ""; ?>
                                                </p>
                                            </figcaption>
                                        </div>
                                    </figure>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="de-onde-vem">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-10">
                        <div class="row pt-5">
                            <div class="col-12">
                                <h2 class="title text-center"><?= $objPage->titulo_de_onde_vem ?? ""; ?></h2>
                            </div>
                        </div>
                        <div class="row line m-0 p-0 justify-content-between content">
                            <?php for ($i = 0; $i < $objPage->processo_frooty; $i++): ?>
                                <?php if ($i % 2 !== 0): ?>
                                    <div class="d-block d-xl-flex py-4">
                                        <div class="col-12 col-xl-5 text-center text-xl-end my-auto mb-4 mb-xl-0 d-xl-none">
                                            <img src="<?= get_post($objPage->{"processo_frooty_" . $i . "_imagem"})->guid ?? ""; ?>" class="img-fluid mt-4 mt-xl-0" alt="Colheita">
                                        </div>
                                        <div class="col-12 col-xl-5 text-center text-xl-start my-auto">
                                            <h2><?= $objPage->{"processo_frooty_" . $i . "_titulo"} ?? ""; ?></h2>
                                            <p class="pe-2"><?= $objPage->{"processo_frooty_" . $i . "_descricao"} ?? ""; ?></p>
                                        </div>

                                        <div class="col-12 col-xl-2 text-center my-auto">
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/acai-real.png" class="img-fluid" alt="Açai">
                                        </div>
                                        <div class="col-12 col-xl-5 text-end my-auto d-none d-xl-block">
                                            <img src="<?= get_post($objPage->{"processo_frooty_" . $i . "_imagem"})->guid ?? ""; ?>" class="img-fluid mt-4 mt-xl-0" alt="Colheita">
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="d-block d-xl-flex py-4">
                                        <div class="col-12 col-xl-5 text-center text-xl-start my-auto">
                                            <img src="<?= get_post($objPage->{"processo_frooty_" . $i . "_imagem"})->guid ?? ""; ?>" class="img-fluid" alt="Colheita">
                                        </div>
                                        <div class="col-12 col-xl-2 text-center my-auto d-none d-xl-block">
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/acai-real-2.png" class="img-fluid mt-3 mt-xl-0" alt="Açai">
                                        </div>
                                        <div class="col-12 col-xl-5 text-end my-auto text-center text-xl-start">
                                            <h2 class="mt-4 mt-xl-0"><?= $objPage->{"processo_frooty_" . $i . "_titulo"} ?? ""; ?></h2>
                                            <p class="pe-2 mt-4 mt-xl-0"><?= $objPage->{"processo_frooty_" . $i . "_descricao"} ?? ""; ?></p>
                                        </div>

                                        <div class="col-12 col-xl-2 text-center my-auto d-block d-xl-none">
                                            <img src="<?= get_template_directory_uri(); ?>/assets/img/acai-real-2.png" class="img-fluid mt-3 mt-xl-0" alt="Açai">
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endfor; ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="certificacoes">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-11 col-xl-10 bg px-0 px-xl-5">
                        <div class="row my-3 my-lg-5 my-xl-5">
                            <div class="col-12">
                                <h2 class="text-center">Certificações</h2>
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <?php foreach ($objCertificacoes as $ok => $cert): ?>
                                <?php $cert->meta = (object)acf_get_meta($cert->ID); ?>
                                <div class="col-6 col-md-4 col-lg-2 col-xl-2 px-xl-4 my-3 my-xl-0 text-center">
                                    <div class="img-selo">
                                        <img src="<?= get_post($cert->meta->icone)->guid; ?>" class="img-fluid pointer" alt="" data-bs-toggle="modal" data-bs-target="#for-life-<?= $cert->ID; ?>">
                                    </div>
                                    <small class="d-block pt-1"><?= strip_tags($cert->post_title) ?? ""; ?></small>
                                </div>
                                <!-- Modal -->
                                <?php if (!empty($cert->post_content)): ?>
                                    <div class="modal fade mt-5 mt-xl-0" id="for-life-<?= $cert->ID; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <?php if ($ok % 2 === 0): ?>
                                                    <div class="modal-body bg-roxo" style="background-image: url('<?= get_post($cert->meta->background_do_modal)->guid ?? ""; ?>');">
                                                        <div class="row px-1 px-xl-5 h-100">
                                                            <div class="col-12 col-xl-4 text-end my-auto d-block d-xl-none">
                                                                <i class="fa fa-times fa-2x text-dark pointer" data-bs-dismiss="modal" aria-label="Close"></i>
                                                            </div>
                                                            <div class="col-12 col-xl-8 my-auto">
                                                                <img src="<?= get_post($cert->meta->icone)->guid; ?>" class="mb-5" alt="Logotipo For Life">
                                                                <p>
                                                                    <?= nl2br($cert->post_content) ?? ""; ?>
                                                                </p>
                                                            </div>
                                                            <div class="col-12 col-xl-4 text-end my-auto d-none d-xl-block">
                                                                <i class="fa fa-times fa-2x text-white pointer" data-bs-dismiss="modal" aria-label="Close"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="modal-body bg-graviola" style="background-image: url('<?= get_post($cert->meta->background_do_modal)->guid ?? ""; ?>');">
                                                        <div class="row justify-content-end">
                                                            <div class="col-1 text-end">
                                                                <div class="bg-rounded text-center">
                                                                    <i class="fa fa-times text-dark pointer" data-bs-dismiss="modal" aria-label="Close"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row px-1 px-xl-5 h-100 justify-content-between">
                                                            <div class="col-12 col-xl-3 my-auto">
                                                                <img src="<?= get_template_directory_uri(); ?>/assets/img/selo-ciclo.png" class="mb-5 img-fluid" alt="Logotipo For Life">
                                                            </div>
                                                            <div class="col-12 col-xl-8 my-auto">
                                                                <p>
                                                                    <?= nl2br($cert->post_content) ?? ""; ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php include_once "templates/sabor-que-nutre.php"; ?>

        <section id="codigo-etica">
            <div class="container">
                <div class="row justify-content-center ">
                    <div class="col-11 col-xl-10 bg px-0 px-xl-5 mb-5">
                        <div class="row mt-5 mb-4">
                            <div class="col-12">
                                <h2 class="text-center"><?= $objPage->titulo_codigo_de_etica ?? ""; ?></h2>
                            </div>
                        </div>
                        <div class="row m-0 p-0 justify-content-center mb-5">
                            <div class="col-12 text-center">
                                <p>
                                    <?= nl2br($objPage->texto_codigo_de_etica) ?? ""; ?>
                                <p>
                            </div>
                            <div class="col-12 text-center my-4">
                                <button class="button frooty-amarelo"><?= $objPage->cta_codigo_de_etica["title"] ?? ""; ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php include_once "templates/partials/footer.php"; ?>