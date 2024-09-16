<?php
$objMenuHeader = wp_get_nav_menu_items("Footer");
$objChamadas = (object)acf_get_meta(431);
$objRedesSociais = get_posts([
    "post_type" => "social",
    "post_status" => "publish",
    "order" => "asc",
    "posts_per_page" => "-1"
]);
?>

<footer>
    <section class="contato py-0 py-xl-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-10">
                    <div class="bg rounded-4 h-100">
                        <div class="row justify-content-center h-100 py-5 px-3 px-xl-0 py-xl-0">
                            <div class="col-12 col-lg-5 col-xl-5 my-auto">
                                <h2 class="mb-3"><?= $objChamadas->titulo ?? ""; ?></h2>
                                <p><?= nl2br($objChamadas->texto) ?? ""; ?></p>
                            </div>
                            <div class="col-12 col-lg-5 col-xl-5 text-center text-lg-end text-xl-end my-auto">
                                <a href="<?= $objChamadas->cta["url"] ?? ""; ?>" target="<?= $objChamadas->cta["target"] ?? ""; ?>">
                                    <button class="button frooty-roxo pitaya mt-4 mt-xl-0"><?= $objChamadas->cta["title"] ?? ""; ?> <i class="fa-solid fa-chevron-right"></i></button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center social mt-5">
                <div class="col-12 col-lg-2 col-xl-2 mb-4 mb-xl-0">
                    <h2 class="text-center text-xl-start">
                        Siga-nos nas <br class="d-none d-xl-block"> Redes Sociais:
                    </h2>
                </div>
                <?php foreach ($objRedesSociais as $sk => $social) : ?>
                    <div class="col-3 col-lg-1 col-xl-1 text-center mb-4 mb-xl-0">
                        <a href="<?= $social->post_content ?? ""; ?>" target="_blank">
                            <img src="<?= get_the_post_thumbnail_url($social->ID) ?? ""; ?>" class="img-fluid" alt="Facebook">
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <menu class="row justify-content-center">
        <?php foreach ($objMenuHeader as $k => $menu) : ?>
            <?php if ($menu->menu_item_parent <= 0) : ?>
                <div class="col-6 col-md-4 col-lg-2 col-xl-2 text-center text-lg-start text-xl-start mb-3 mb-xl-3">
                    <ul>
                        <li><a href=""><?= $menu->title ?? ""; ?></a></li>
                        <?php foreach ($objMenuHeader as $sk => $submenu) : ?>
                            <?php if ($submenu->menu_item_parent == $menu->ID) : ?>
                                <li><a href="<?= $submenu->url; ?>" target="<?= $submenu->target; ?>"><?= $submenu->title; ?></a></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </menu>
    <div class="row copyright h-100">
        <div class="col-12 text-center my-auto">
            <p class="mb-0">Copyright © Frooty. Todos os direitos reservados</p>
        </div>
    </div>
</footer>
<div id="search-modal" class="modal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row h-100">
                    <div class="col-12 col-xl-11 my-auto">
                        <form action="<?= get_site_url(); ?>/busca" class="form-group position-relative container-content">
                            <input type="text" name="termo" class="form-control" placeholder="Digite aqui sua busca" required>
                            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>
                    <div class="col-2 col-xl-1 my-auto d-none d-md-flex">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="w-100 py-3" id="attri-rodape">
    <div class="container">
        <div class="row justify-content-lg-end justify-content-center">
            <div class="col-auto">
                <a href="http://attri.com.br" target="_blank" rel="noopener noreferrer">
                    Made by <img src="<?= get_template_directory_uri(); ?>/assets/img/logo-a-attri.png" alt="" srcset="">
                </a>
                <style>
                    #attri-rodape a {
                        color: #939393;
                        font-weight: 600;
                        font-size: 14px;
                        display: flex;
                        gap: .51rem;
                        align-items: center;
                    }
                </style>
            </div>
        </div>
    </div>
</div>
<script src="https://kit.fontawesome.com/44c495304d.js" crossorigin="anonymous"></script>
<script src="<?= get_template_directory_uri(); ?>/assets/plugins/jquery/jquery.3.6.js"></script>
<script type="text/javascript" src="<?= get_template_directory_uri(); ?>/assets/plugins/slick-1.8.1/slick/slick.js"></script>
<script src="<?= get_template_directory_uri(); ?>/assets/plugins/bootstrap-5.2.0/js/bootstrap.bundle.js"></script>
<script src="<?= get_template_directory_uri(); ?>/assets/plugins/jQuery-Mask-Plugin/dist/jquery.mask.js"></script>
<script src="<?= get_template_directory_uri(); ?>/assets/plugins/jquery-loading-master/dist/jquery.loading.min.js"></script>
<script src="<?= get_template_directory_uri(); ?>/assets/plugins/cep/cep.js"></script>
<script src="<?= get_template_directory_uri(); ?>/assets/plugins/animsition-master/src/js/animsition.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= get_template_directory_uri(); ?>/assets/js/main.js?v=1"></script>
<script src="https://www.google.com/recaptcha/api.js?render=6Ld20qgnAAAAAB5xPf8zEb4BCXcMlAJqdid5IKoG"></script>
<script>
    // grecaptcha.ready(function() {
    //     grecaptcha.execute('6Ld20qgnAAAAAB5xPf8zEb4BCXcMlAJqdid5IKoG', {
    //         action: 'submit'
    //     }).then(function(token) {
    //         console.log(token);
    //         $("input[name='recaptchaToken']").val(token);
    //     });
    // });


function atualizarTokenRecaptcha() {
    grecaptcha.ready(function() {
        grecaptcha.execute('6Ld20qgnAAAAAB5xPf8zEb4BCXcMlAJqdid5IKoG', {
            action: 'submit'
        }).then(function(token) {
            //console.log(token);
            $("input[name='recaptchaToken']").val(token);
        });
    });
}

atualizarTokenRecaptcha();
</script>
</body>

</html>