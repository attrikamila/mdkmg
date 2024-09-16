<?php
include_once "templates/partials/header.php";
$objPage = (object)acf_get_meta(12);

?>
    <main id="sustentabilidade" class="mb-5">
        <section id="cuidar-natureza">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-10">
                        <div class="row m-0 p-0 justify-content-between h-100 position-relative">
                            <div class="col-12 col-md-5 col-xl-5">
                                <h2><?= nl2br($objPage->titulo) ?? ""; ?></h2>
                                <img src="<?= get_post($objPage->imagem_compromisso)->guid ?? ""; ?>" class="img-fluid" alt="Manifesto">
                            </div>
                            <div class="col-12 col-md-6 col-xl-6 my-auto absolute px-4 pt-3 pt-xl-0 px-md-0 px-xl-0">
                                <h3><?= $objPage->titulo_compromisso ?? ""; ?></h3>
                                <p>
                                    <?= nl2br($objPage->texto_compromisso) ?? ""; ?>
                                </p>
                                <a href="<?= $objPage->cta_compromisso["url"] ?? ""; ?>" target="<?= $objPage->cta_compromisso["target"] ?? ""; ?>">
                                    <button class="button frooty-amarelo mt-5"><?= $objPage->cta_compromisso["title"] ?? ""; ?></button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="features">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-8">
                        <?php for ($i = 0; $i < $objPage->features; $i++): ?>
                            <div class="row m-0 p-0 justify-content-between mb-5">
                                <div class="col-2 col-xl-1">
                                    <img src="<?= get_post($objPage->{"features_".$i."_icone"})->guid; ?>" class="img-fluid" alt="Icone Mundo">
                                </div>
                                <div class="col-10 col-xl-11">
                                    <h2><?= $objPage->{"features_".$i."_titulo"} ?? ""; ?></h2>
                                    <p><?= nl2br($objPage->{"features_".$i."_descricao"}) ?? ""; ?></p>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </section>

        <section id="video">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-10">
                        <video width="100%" poster="<?= get_template_directory_uri(); ?>/assets/img/frooty-capa.jpg" controls>
                            <source src="<?= get_post($objPage->video_sustentabilidade)->guid ?? ""; ?>" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
        </section>

        <?php include_once "templates/depoimentos.php"; ?>

        <section id="comprometimento">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-10">
                        <div class="row m-0 p-0 justify-content-between h-100 position-relative">
                            <div class="col-12 col-md-6 col-xl-6 my-auto absolute px-4 pt-3 pt-xl-0 px-md-0 px-xl-0">
                                <h2><?= $objPage->titulo_o_meio_ambiente ?? ""; ?></h2>
                                <?= nl2br($objPage->texto_o_meio_ambiente) ?? ""; ?>
                            </div>
                            <div class="col-12 col-md-5 col-xl-5 my-auto">
                                <img src="<?= get_post($objPage->imagem_o_meio_ambiente)->guid ?? ""; ?>" class="img-fluid" alt="Manifesto">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-5 py-5"></div>
            </div>
        </section>

    </main>
<?php include_once "templates/partials/footer.php"; ?>