<?php
include_once "templates/partials/header.php";
$objIngredientes = get_terms('categoria__ingrediente_produto', array('hide_empty' => false, "order" => "asc"));
$objDificuldade = get_terms('categoria__dificuldade', array('hide_empty' => false, "order" => "asc"));
$tax[] = array(
    'taxonomy' => 'categoria__receitas',
    'field' => 'slug',
    'terms' => ["para-voce"],
    'compare' => "IN"
);
if (!empty($_GET["dificuldade"])) {
    $tax[] = array(
        'taxonomy' => 'categoria__dificuldade',
        'field' => 'slug',
        'terms' => $_GET["dificuldade"],
        'compare' => "IN"
    );
}
$arrArgs = array(
    "s" => $_GET["termo"] ?? "",
    'posts_per_page' => "-1",
    "post_type" => "receitas",
    "post_status" => "publish",
    "order" => "ASC",
    "tax_query" => [
        'relation' => 'AND',
        $tax
    ]
);
$objReceita = get_posts($arrArgs);
?>
<main id="receitas" class="mb-5">
    <section id="title">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <h3>Para Você</h3>
                    <h2>Receitas Frooty</h2>
                    <p>Sabores e combinações que vão muito além do pote!</p>
                </div>
            </div>
        </div>
    </section>

    <section id="filters">
        <form class="container" method="GET" action="">
            <div class="row">
                <div class="col-12 col-md-6 col-xl-3 form-group mb-4 mb-xl-0">
                    <select name="" class="form-control">
                        <option value="">Filtre por ingrediente</option>
                        <?php foreach ($objIngredientes as $ik => $ing) : ?>
                            <option value="<?= $ing->name ?? "" ?>"><?= $ing->name ?? "" ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12 col-md-6 col-xl-3 form-group mb-4 mb-xl-0">
                    <select name="dificuldade" class="form-control">
                        <option value="">Filtre por nível de dificuldade</option>
                        <?php foreach ($objDificuldade as $dk => $dificuldade) : ?>
                            <option value="<?= $dificuldade->slug ?? ""; ?>" <?= $dificuldade->slug == $_GET["dificuldade"] ? "selected" : ""; ?>><?= $dificuldade->name ?? ""; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12 col-xl-6 form-group mb-4 mb-xl-0 position-relative">
                    <i class="fa fa-search position-absolute" onclick="$(this).closest('form').submit();"></i>
                    <input type="text" name="termo" class="form-control" placeholder="Busque por uma palavra" value="<?= $_GET["termo"] ?? ""; ?>">
                </div>
            </div>
        </form>
    </section>

    <section class="receitas">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row tab active" id="tab-voce">
                        <?php if (count($objReceita) > 0) : ?>
                            <?php foreach ($objReceita as $rk => $receita) : ?>
                                <div class="col-12 col-md-6 col-lg-4 col-xl-4 mb-5">
                                    <figure class="text-center">
                                        <a href="<?= get_site_url(); ?>/receitas/<?= $receita->post_name ?? ""; ?>">
                                            <img src="<?= get_the_post_thumbnail_url($receita->ID) ?? ""; ?>" alt="<?= $receita->post_title ?? ""; ?>">
                                        </a>
                                        <figcaption>
                                            <h2 class="my-4"><?= $receita->post_title ?? ""; ?></h2>
                                            <a href="<?= get_site_url(); ?>/receitas/<?= $receita->post_name ?? ""; ?>">
                                                <button class="button frooty-outline">Experimentar <i class="fa-solid fa-chevron-right"></i></button>
                                            </a>
                                        </figcaption>
                                    </figure>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <h4 class="not-found text-center">Nenhum resultado encontrado</h4>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="pagination">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center align-middle">
                    <i class="fa fa-chevron-left"></i>
                    <i class="fa-solid fa-circle active"></i>
                    <!--                    <i class="fa-solid fa-circle"></i>-->
                    <!--                    <i class="fa-solid fa-circle"></i>-->
                    <!--                    <i class="fa-solid fa-circle"></i>-->
                    <!--                    <i class="fa-solid fa-circle"></i>-->
                    <!--                    <i class="fa-solid fa-circle"></i>-->
                    <i class="fa fa-chevron-right"></i>
                </div>
            </div>
            <!-- <div class="row my-5 py-5"></div> -->
        </div>
    </section>

    <section id="qrcode" class="py-4">
        <div class="container">
            <div class="row">
                    <h2 class="text-center" style="color: #43297C; font-family: 'FrootyADP', sans-serif; font-size: 2.5rem;">Escaneie aqui e baixe seu Guia de Receitas Frooty</h2>
                    <img src="<?= get_template_directory_uri(); ?>/assets/img/guia-receitas.png" class="img-fluid" style="width: 300px; margin: 25px auto 80px;" alt="">
            </div>
        </div>
    </section>

</main>
<?php include_once "templates/partials/footer.php"; ?>