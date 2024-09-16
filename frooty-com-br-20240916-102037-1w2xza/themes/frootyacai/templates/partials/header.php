<?php
$objMenuHeader = wp_get_nav_menu_items("Header");
$logo = get_theme_mod('custom_logo');
$logoUrl = wp_get_attachment_image_src($logo, 'full');
$objIntegracoesHeader = get_posts([
    'posts_per_page' => "-1",
    "post_type" => "integracoes",
    "post_status" => "publish",
    "order" => "DEC",
    "tax_query" => [
        'relation' => 'AND',
        [
            'taxonomy' => 'categoria_integracoes',
            'field' => 'slug',
            'terms' => ["headercabecalho"],
            'compare' => "IN"
        ]
    ]
]);
$objIntegracoesBody = get_posts([
    'posts_per_page' => "-1",
    "post_type" => "integracoes",
    "post_status" => "publish",
    "order" => "DEC",
    "tax_query" => [
        'relation' => 'AND',
        [
            'taxonomy' => 'categoria_integracoes',
            'field' => 'slug',
            'terms' => ["bodyinicio-do-conteudo"],
            'compare' => "IN"
        ]
    ]
]);
?>
<!doctype html>
<html lang="pt-br">

<head>
    <?php foreach ($objIntegracoesHeader as $bk => $integracao) : ?>
        <?php $integracao->meta = (object)acf_get_meta($integracao->ID); ?>
        <?= trim($integracao->meta->codigo_de_incorporacao) . "\n"; ?>
    <?php endforeach; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="title" content="<?= get_bloginfo('name'); ?>">
    <meta name="description" content="<?= get_bloginfo('description'); ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= get_bloginfo('url'); ?>">
    <meta property="og:title" content="<?= get_bloginfo('name'); ?>">
    <meta property="og:description" content="<?= get_bloginfo('description'); ?>">
    <meta property="og:image" content="<?= get_template_directory_uri(); ?>/assets/meta-tags-16a33a6a8531e519cc0936fbba0ad904e52d35f34a46c97a2c9f6f7dd7d336f2.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= get_bloginfo('url'); ?>">
    <meta property="twitter:title" content="<?= get_bloginfo('name'); ?>">
    <meta property="twitter:description" content="<?= get_bloginfo('description'); ?>">
    <meta property="twitter:image" content="<?= get_template_directory_uri(); ?>/assets/meta-tags-16a33a6a8531e519cc0936fbba0ad904e52d35f34a46c97a2c9f6f7dd7d336f2.png">
    <!-- FIM METAS -->
    <title><?= get_bloginfo('name'); ?></title>
    <link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/assets/plugins/bootstrap-5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= get_template_directory_uri(); ?>/assets/plugins/slick-1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="<?= get_template_directory_uri(); ?>/assets/plugins/slick-1.8.1/slick/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="<?= get_template_directory_uri(); ?>/assets/plugins/animsition-master/src/css/animsition.css" />
    <link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/assets/css/responsive.css">
    <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script>
        function trocarIdioma(sigla) {
            if (sigla == 'pt') {
                voltarAoIdiomaOriginal()
            }
            // Obtém o elemento do widget de tradução
            var googleTranslateElement = document.getElementById('google_translate_element');

            // Cria um novo evento 'change'
            var event = new Event('change');

            // Dispara o evento 'change' no elemento do widget de tradução
            googleTranslateElement.dispatchEvent(event);

            // Define o idioma de destino
            var comboGoogleTradutor = googleTranslateElement.querySelector(".goog-te-combo");
            if (comboGoogleTradutor) {
                comboGoogleTradutor.value = sigla;
                comboGoogleTradutor.dispatchEvent(event); // Dispara a troca de idioma
            }
        }

        function voltarAoIdiomaOriginal() {
            // Recarrega a página para voltar ao idioma original
            document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            window.location.reload();
        }
    </script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'pt',
                autoDisplay: false,
                includedLanguages: 'en,es,pt,zh-CN',
                layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL
            }, 'google_translate_element');
        }
    </script>

</head>

<body class="position-relative">
    <?php foreach ($objIntegracoesBody as $bk => $body) : ?>
        <?php $body->meta = (object)acf_get_meta($body->ID); ?>
        <?= $body->meta->codigo_de_incorporacao . "\n"; ?>
    <?php endforeach; ?>
    <header>
        <div id="google_translate_element"></div>
        <div class="container">
            <div id="mobile-menu-container" class="d-block d-lg-none d-xl-none">
                <div class="row h-100">
                    <div class="col-10 col-xl-2 my-auto container-logo-mobile">
                        <!-- <a href="<?= get_site_url(); ?>" class="animsition-link"> -->
                        <!-- <img class="img-fluid" src="https://frooty.com.br/wp-content/uploads/2022/09/logo-frooty.png" alt="Logotipo Frooty Açai"> -->
                        <!-- </a> -->
                    </div>
                    <div class="col-2 text-end my-auto">
                        <i id="trigger-menu" class="fa-solid fa-bars"></i>
                    </div>
                </div>
            </div>
            <nav class="pt-0 pt-md-4 pt-lg-5 pt-xl-4">
                <div class="row h-100">
                    <div class="col-12 p-0 m-0 bg-menu"></div>
                    <div class="col-12 col-md-12 col-lg-2 col-xl-2 my-auto container-logo">
                        <div class="text-end d-block d-lg-none d-xl-none py-2">
                            <i id="trigger-close-menu" class="fa-solid fa-times"></i>
                        </div>
                        <a href="<?= get_site_url(); ?>" class="animsition-link">
                            <img class="img-fluid mt-4 w-75" src="<?= $logoUrl[0]; ?>" alt="Logotipo Frooty Açai">
                        </a>
                    </div>
                    <menu class="col-12 col-md-10 col-lg-10 col-xl-10">
                        <ul class="position-relative d-block d-lg-flex d-xl-flex">
                            <?php foreach ($objMenuHeader as $k => $menu) : ?>
                                <?php if ($menu->menu_item_parent <= 0) : ?>
                                    <li class="position-relative <?= $menu->classes[0] == "dropdown" ? "trigger-menu" : ""; ?> h-100">
                                        <a href="<?= $menu->classes[0] != "dropdown" ? $menu->url : "javascript:void(0);"; ?>"><?= $menu->title ?? ""; ?> <i class="fa-solid fa-chevron-down ps-2 <?= $menu->classes[0] != "dropdown" ? "d-none" : ""; ?>"></i></a>
                                        <ul class="position-absolute submenu pt-4">
                                            <?php foreach ($objMenuHeader as $sk => $submenu) : ?>
                                                <?php if ($submenu->menu_item_parent == $menu->ID) : ?>
                                                    <li><a href="<?= $submenu->url; ?>" class="animsition-link"><?= $submenu->title; ?></a></li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <li>
                                <select name="language" onchange="trocarIdioma(this.value)" class="select-input">
                                    <option value="pt">Português</option>
                                    <option value="es">Espanhol</option>
                                    <option value="en">Inglês</option>
                                    <option value="zh-CN">Chinês</option>
                                </select>
                                <!-- <a href="#" onclick="voltarAoIdiomaOriginal()">PT</a>
                                <span>│</span>
                                <a href="javascript:trocarIdioma('es')">ES</a>
                                <span>│</span>
                                <a href="javascript:trocarIdioma('en')">EN</a> -->
                            </li>
                            <li data-bs-toggle="modal" data-bs-target="#search-modal" onclick="$('#trigger-close-menu').click();"><i class="fa-solid fa-magnifying-glass"></i></li>
                        </ul>
                    </menu>
                </div>
            </nav>
        </div>
    </header>