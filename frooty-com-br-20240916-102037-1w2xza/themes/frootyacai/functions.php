<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require WP_PLUGIN_DIR . '/phpmailer/src/Exception.php';
require WP_PLUGIN_DIR . '/phpmailer/src/PHPMailer.php';
require WP_PLUGIN_DIR . '/phpmailer/src/SMTP.php';

add_action('after_setup_theme', 'generic_setup');
function generic_setup()
{
    load_theme_textdomain('generic', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array('search-form', 'navigation-widgets'));
    add_theme_support('woocommerce');
    global $content_width;
    if (!isset($content_width)) {
        $content_width = 1920;
    }
    register_nav_menus(array('main-menu' => esc_html__('Main Menu', 'generic')));
}

// CSS inline para o painel admin
function generic_inline_css()
{
    echo '<style>
    body {
        background-color: #fff;
    }
    
    .post-type-page .block-editor-block-list__layout,
    #advanced-custom-fields-pro-update,
    .update[data-slug=advanced-custom-fields-pro],
    .update-plugins.count-2,
    .theme-info .notice.notice-warning,
    .theme-autoupdate {
        display: none !important;
    }
    
    .post-type-page .edit-post-visual-editor {
        flex: 0 0 auto !important;
    }
    
    .edit-post-layout .interface-interface-skeleton__content {
        background-color: transparent !important;
    }
    
    .edit-post-layout__metaboxes:not(:empty) .edit-post-meta-boxes-area {
        margin: 0 auto !important;
    }
    
//    .small-height {
//        height: 150px !important;
//    }
//    
//    .small-height iframe {
//        height: 150px !important;
//        min-height: 150px !important;
//    }
    #wpadminbar #wp-admin-bar-wp-logo>.ab-item {
    padding: 0 7px;
    background-image: url(' . get_site_icon_url() . ') !important;
    background-size: 70%;
    background-position: center;
    background-repeat: no-repeat;
    opacity: 0.8;
    }
    #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
        content: " ";
        top: 2px;
    }
    .components-button.edit-post-fullscreen-mode-close svg{
        display: none;
    }
    .components-button.edit-post-fullscreen-mode-close {
        width: "36px";
        height: "36px";
        background-image: url(' . get_site_icon_url() . ') !important;
        background-size: 50%;
        background-position: center;
        background-repeat: no-repeat;
    }
  </style>';
}

add_action('admin_head', 'generic_inline_css');

function generic_inline_js()
{
    echo "
        <script>
//            document.addEventListener('DOMContentLoaded', function(){
//               setTimeout(function() {
//                   let elmt = jQuery('#editor .edit-post-post-link__link-prefix');
//                   elmt.text(elmt.text() + 'blog/');
//                   
//                   let newUrl = jQuery('.edit-post-post-link__link-prefix').text() + jQuery('.edit-post-post-link__link-post-name').text() + jQuery('.edit-post-post-link__link-suffix').text(); 
//                   jQuery('#editor .edit-post-post-link__link, .edit-post-header-preview__button-external').attr('href', newUrl);
//               },2000); 
//            });
        </script>  
    ";
}

add_action('admin_footer', 'generic_inline_js');

// Menu Names
function change_post_menu_label()
{
    global $menu;
    global $submenu;
    $menu[5][0] = 'Blog'; // Change name for tags
    echo '';
}
add_action('admin_menu', 'change_post_menu_label');


/*EDITAR PAINEL DE LOGIN*/
function my_custom_login_stylesheet()
{
    wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/style.css');
}

add_action('login_enqueue_scripts', 'my_custom_login_stylesheet');


/*ESQUEMA DE CORES DO PAINEL*/
function frooty_aai_admin_color_scheme()
{
    //Get the theme directory
    $theme_dir = get_stylesheet_directory_uri();

    //Frooty Açai
    wp_admin_css_color(
        'frooty_aai',
        __('Frooty Açai'),
        $theme_dir . '/frooty_aai.css',
        array('#43297c', '#fff', '#ed0973', '#ffcb05')
    );
}
add_action('admin_init', 'frooty_aai_admin_color_scheme');


/*REMOVER POST BLOG E COMENTARIOS*/
function remove_links_menu()
{
    remove_menu_page('edit.php'); // Posts
    remove_menu_page('edit-comments.php'); // Comentarios
}

add_action('admin_menu', 'remove_links_menu');

// Retorna localidades por estado
function returnFromBrasilForm()
{
    header('Access-Control-Allow-Origin: *');
    $objLocais = get_posts([
        "post_type" => "locais",
        "post_status" => "publish",
        "order" => "asc",
        "posts_per_page" => "-1",
        "tax_query" => [
            'relation' => 'AND',
            array(
                'taxonomy' => 'locais',
                'field' => 'slug',
                'terms' => "brasil",
                'compare' => "IN"
            ),
            array(
                'taxonomy' => 'uf',
                'field' => 'slug',
                'terms' => strtolower($_GET["uf"]),
                'compare' => "IN"
            )
        ]
    ]);

    foreach ($objLocais as $ok => $local) {
        $objLocais[$ok]->meta = acf_get_meta($local->ID);
    }

    return json_encode($objLocais);
}

add_action('rest_api_init', function () {
    register_rest_route('wp/v2', 'return-form-brasil', array(
        'methods' => 'GET',
        'callback' => 'returnFromBrasilForm',
        'permission_callback' => '__return_true',
    ));
});

// Retorna localidades por estado
function returnFromWorldForm()
{
    header('Access-Control-Allow-Origin: *');
    $_GET["country"] = str_replace(" ", "-", strtolower($_GET["country"]));
    $_GET["country"] = $_GET["country"] == "brazil" ? "brasil" : $_GET["country"];
    $objLocais = get_posts([
        "post_type" => "locais",
        "post_status" => "publish",
        "order" => "asc",
        "posts_per_page" => "-1",
        "tax_query" => [
            'relation' => 'AND',
            array(
                'taxonomy' => 'locais',
                'field' => 'slug',
                'terms' => strtolower($_GET["country"]),
                'compare' => "IN"
            )
        ]
    ]);

    foreach ($objLocais as $ok => $local) {
        $objLocais[$ok]->meta = acf_get_meta($local->ID);
    }

    return json_encode($objLocais);
}

add_action('rest_api_init', function () {
    register_rest_route('wp/v2', 'return-form-world', array(
        'methods' => 'GET',
        'callback' => 'returnFromWorldForm',
        'permission_callback' => '__return_true',
    ));
});

function sendContactForm()
{
    header('Access-Control-Allow-Origin: *');
    $arrPost = $_POST;
    // var_dump($arrPost);
    // exit;
    if (!empty($arrPost)) {
        $objPage = (object)acf_get_meta(14);
        $to = $objPage->{$arrPost["tipo"]} ?? "sac.consumidor@frooty.com.br";
        $toName = get_option("blogname");

        $arrFields[] = $arrPost['nome'] ? "<strong>Nome:</strong> " . ucfirst($arrPost['nome']) : "";
        $arrFields[] = $arrPost['vaga'] ? "<strong>Vaga de Interesse:</strong> " . ucfirst($arrPost['vaga']) : "";
        $arrFields[] = $arrPost['cnpj'] ? "<strong>CNPJ:</strong> " . $arrPost['cnpj'] : "";
        $arrFields[] = $arrPost['razao_social'] ? "<strong>Razão Social:</strong> " . ucfirst($arrPost['razao_social']) : "";
        $arrFields[] = $arrPost['email'] ? "<strong>E-mail:</strong> " . strtolower($arrPost['email']) : "";
        $arrFields[] = $arrPost['telefone'] ? "<strong>Telefone:</strong> " . $arrPost['telefone'] : "";
        $arrFields[] = $arrPost['cep'] ? "<strong>CEP:</strong> " . $arrPost['cep'] : "";
        $arrFields[] = $arrPost['endereco'] ? "<strong>Endereço:</strong> " . $arrPost['endereco'] : "";
        $arrFields[] = $arrPost['numero'] ? "<strong>Número:</strong> " . $arrPost['numero'] : "";
        $arrFields[] = $arrPost['complemento'] ? "<strong>Complemento:</strong> " . $arrPost['complemento'] : "";
        $arrFields[] = $arrPost['cidade'] ? "<strong>Cidade:</strong> " . $arrPost['cidade'] : "";
        $arrFields[] = $arrPost['estado'] ? "<strong>Estado:</strong> " . $arrPost['estado'] : "";
        $arrFields[] = $arrPost['assunto'] ? "<strong>Assunto:</strong> " . $arrPost['assunto'] : "";
        $arrFields[] = $arrPost['mensagem'] ? "<strong>Mensagem:</strong> " . nl2br($arrPost['mensagem']) : "";
        $arrFields[] = $arrPost['aceite'] ? "<strong>Aceitou os termos?:</strong> " . $arrPost['aceite'] : "";
        $arrFields = array_filter($arrFields);
        $html =
            '
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>' . $toName . '</title>
</head>
<body style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif;  font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #ffffff; margin: 0;" bgcolor="#ffffff">
<table width="100%" cellpadding="0" cellspacing="0" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif;  font-size: 14px; margin: 0;">
    <tbody>
    <tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif;  font-size: 14px; margin: 0;">
        <td class="content-block" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif;  font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
            Olá equipe Frooty!
            <br><br>
            Vocês estão recebendo um novo contato de: ' . ucfirst(strtolower($arrPost["tipo"])) . '.
            <br><br>
            ' . implode("<br><br>", $arrFields) . '
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>';
        $mail = new PHPMailer(true);
        try {

            // Recupera el token enviado desde el formulario
            $recaptchaToken = $arrPost['recaptchaToken'];

            // Llave secreta de ReCAPTCHA proporcionada por Google
            $recaptchaSecretKey = '6Ld20qgnAAAAAAsxfQQsjtczmDlbrILdlWQKinL0';

            // Verifica el token con Google
            $ch = curl_init();

            $url = "https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecretKey}&response={$recaptchaToken}";

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            $responseKeys = json_decode($response, true);

            curl_close($ch);
            // Verifica la respuesta
            //if (intval($responseKeys["success"]) !== 1) {
            if (intval($responseKeys["success"]) !== 1) {
                // El ReCAPTCHA no se validó, maneja el caso en consecuencia (puede ser un bot)
                echo json_encode("Erro no envio, verifique e tente novamente!");
                exit();
            } else {
                // El ReCAPTCHA se validó, continúa con el procesamiento del formulario


                //Server settings
                $mail->SMTPDebug = false;
                $mail->CharSet = $objPage->charset ?? "";
                $mail->isSMTP();
                $mail->Host = $objPage->host ?? "";

                //Set the SMTP server to send through
                $mail->SMTPAuth = true;
                $mail->Username = $objPage->usuario_email ?? "";
                $mail->Password = $objPage->senha ?? "";
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = $objPage->porta_para_envio ?? "";

                //Recipients
                $mail->setFrom($objPage->usuario_email, "Frooty Açaí");
                $mail->addAddress($to, $toName);     //Add a recipient
                $mail->addReplyTo($arrPost["email"], $arrPost["nome"]);
                //$mail->addCC('lucas.queiroz@attri.com.br');
                //$mail->addCC('gabi.silva@attri.com.br');

                //Attachments
                if (!empty($_FILES["anexo"]["tmp_name"])) {
                    $mail->addAttachment($_FILES["anexo"]["tmp_name"], $_FILES["anexo"]["name"]);
                }

                //Content
                $mail->isHTML(true);
                $mail->Subject = "Contato Site - " . ucfirst(strtolower($arrPost["tipo"]));
                $mail->Body = $html;

                $mail->send();
                
                return http_response_code(200);
                exit();
            }
        } catch (Exception $e) {
            return http_response_code(400);
            exit();
        }
    }

    echo json_encode("Nenhum dado enviado!");
    exit();
}

add_action('rest_api_init', function () {
    register_rest_route('wp/v2', 'send-contact-form', array(
        'methods' => 'POST',
        'callback' => 'sendContactForm',
        'permission_callback' => '__return_true'
    ));
});


