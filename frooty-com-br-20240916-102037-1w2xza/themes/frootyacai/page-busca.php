<?php
include_once "templates/partials/header.php";
$arrArgs = array(
    "s" => $_GET["termo"] ?? "",
    'posts_per_page' => "-1",
    "post_type" => "receitas",
    "post_status" => "publish",
    "order" => "ASC"
);

$objReceita = get_posts($arrArgs);
?>
    <main id="busca" class="mb-5">
        <section id="title">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-10">
                        <div class="row m-0 p-0 justify-content-center">
                            <div class="col-12 col-xl-6 text-center">
                                <p>Você buscou por:</p>
                                <h2><?= $_GET["termo"] ?? ""; ?></h2>
                            </div>
                        </div>
                        <div class="row mt-0 mt-xl-5 justify-content-center">
                            <div class="col-12 text-center">
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="result">
            <div class="container">
                <?php if (count($objReceita) >= 1): ?>
                    <div class="row justify-content-center found">
                        <div class="col-12 col-xl-10">
                            <h2 class="mb-5">Receitas</h2>
                            <?php foreach ($objReceita as $rk => $rec): ?>
                                <?php $rec->meta = (object)acf_get_meta($rec->ID); ?>
                                <div class="item mb-5">
                                    <a href="<?= get_site_url(); ?>/receitas/<?= $rec->post_name ?? ""; ?>">
                                        <h3><?= $rec->post_title ?? ""; ?></h3>
                                        <p>
                                            <?php for ($i = 0; $i < $rec->meta->etapa; $i++): ?>
                                                <?php for ($z = 0; $z < $rec->meta->{"etapa_" . $i . "_ingredientes"}; $z++): ?>
                                                    <?= $rec->meta->{"etapa_" . $i . "_ingredientes_" . $z . "_ingrediente_item"} ?? ""; ?>
                                                <?php endfor; ?>
                                            <?php endfor; ?>
                                            ...
                                        </p>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="row justify-content-center not-found">
                    <div class="col-12 col-xl-8">
                        <?php if (count($objReceita) <= 0): ?>
                            <h2 class="mb-5 text-center">Ops!</h2>
                            <h3 class="mb-5 text-center">Nenhum resultado foi encontrado.</h3>
                        <?php endif; ?>
                        <form action="<?= get_site_url(); ?>/busca" method="GET">
                            <div class="form-group position-relative">
                                <i class="fa fa-search position-absolute" onclick="$(this).closest('form').submit();"></i>
                                <input type="text" name="termo" class="form-control" placeholder="Refazer busca" value="<?= $_GET["termo"] ?? ""; ?>">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row my-5 py-5"></div>
            </div>
        </section>


    </main>
<?php include_once "templates/partials/footer.php"; ?>