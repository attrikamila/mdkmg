<?php
include_once "templates/partials/header.php";
$objPage = (object)acf_get_meta(22);
$objPoliticas = get_posts([
    "post_type" => "politicas",
    "post_status" => "publish",
    "order" => "asc",
    "posts_per_page" => "-1",
]);
?>
    <main id="codigo-politicas">
        <section id="title">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-7 text-center">
                        <h2><?= $objPage->titulo ?? ""; ?></h2>
                        <p>
                            <?= $objPage->descricao ?? ""; ?>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section id="politicas">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-10">
                        <div class="accordion" id="accordionProduto">
                            <?php foreach ($objPoliticas as $i => $politica): ?>
                                <?php $politica->meta = (object)acf_get_meta($politica->ID); ?>
                                <div class="accordion-item mb-2">
                                    <h3 class="accordion-header" id="heading<?= $i; ?>">
                                        <?php if (!empty($politica->meta->link_politica_externa)): ?>
                                            <a href="<?= $politica->meta->link_politica_externa; ?>" target="_blank">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $i; ?>" aria-expanded="true" aria-controls="collapse<?= $i; ?>">
                                                    <i class="fa fa-plus pe-2"></i> <?= $politica->post_title ?? ""; ?>
                                                </button>
                                            </a>
                                        <?php else: ?>
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $i; ?>" aria-expanded="true" aria-controls="collapse<?= $i; ?>">
                                                <i class="fa fa-plus pe-2"></i> <?= $politica->post_title ?? ""; ?>
                                            </button>
                                        <?php endif; ?>
                                    </h3>
                                    <div id="collapse<?= $i; ?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionProduto">
                                        <div class="accordion-body px-0">
                                            <?= nl2br($politica->post_content) ?? ""; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="container-contato">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-10 bg">
                        <h2 class="mb-4"><?= nl2br($objPage->titulo_do_formulario) ?? ""; ?></h2>
                        <p class="mb-5"><?= nl2br($objPage->texto_formulario) ?? ""; ?></p>

                        <form action="<?= get_site_url(); ?>/wp-json/wp/v2/send-contact-form" method="POST" class="request">
                            <input type="hidden" name="tipo" value="consumidor">
                            <div class="form-group mb-3">
                                <input type="text" name="nome" placeholder="Nome completo" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="email" name="email" placeholder="E-mail" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" name="telefone" placeholder="Telefone" class="form-control phone" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="aceite" class="radio">
                                    <input type="radio" id="aceite" name="aceite" value="Sim" required> <span>Declaro que aceito os termos da <a href="">Política de Privacidade</a> do site.</span>
                                </label>
                            </div>

                            <button type="submit" class="button frooty-pitaya mt-3">Enviar</button>
                        </form>
                    </div>
                </div>
                <div class="row my-5 py-5"></div>
            </div>
        </section>
    </main>
<?php include_once "templates/partials/footer.php"; ?>