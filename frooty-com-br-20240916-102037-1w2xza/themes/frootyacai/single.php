<?php
include_once "templates/partials/header.php";

$objProd = get_queried_object();

$objProd->meta = (object)acf_get_meta($objProd->ID);
$objProd->ingredientes = get_the_terms($objProd->ID, 'categoria__ingrediente_produto');

if ($objProd->ingredientes) {
    $objIngredientes = get_field('ingredientes', $objProd->ID);
}


$objProds = get_posts([
    "post_type" => "produtos",
    "post_status" => "publish",
    "order" => "asc",
    // "posts_per_page" => "15"
]);
shuffle($objProds);
?>
<main id="produto" class="mb-5">
    <section id="single">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-10">
                    <div class="row m-0 p-0 justify-content-between h-100 position-relative">
                        <div class="col-12 col-md-6 col-xl-6 d-block d-xl-none mb-4">
                            <!-- <img src="<?php //get_the_post_thumbnail_url($objProd->ID) ?? ""; ?>" class="img-fluid" alt="Manifesto"> -->
                            <img src="<?= !empty(get_field('imagem_de_destaque', $objProd->ID)) ? get_field('imagem_de_destaque', $objProd->ID) : get_the_post_thumbnail_url($objProd->ID) ?? ""; ?>" class="img-fluid" alt="Manifesto">
                        </div>
                        <div class="col-12 col-md-5 col-xl-5">
                            <h2 class="mb-5"><?= $objProd->post_title ?? ""; ?></h2>
                            <?= $objProd->post_content ?? ""; ?>

                            <div class="accordion" id="accordionProduto">
                                <div class="accordion-item mb-2">
                                    <h3 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <i class="fa fa-plus pe-2"></i> Ingredientes
                                        </button>
                                    </h3>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionProduto">
                                        <div class="accordion-body px-0">
                                            <p class="ingredientes <?= count($objIngredientes) < 1 ? 'd-none' : 'igig'; ?>">

                                                <?php
                                                $string = '';
                                                foreach ($objIngredientes as $ik => $ing) :
                                                    $description = !empty(term_description($ing)) ? ' (' . term_description($ing) . ')' : '';

                                                    //$string = "";

                                                ?>
                                                    <?php $string .=  str_replace(['<p>', '</p>'], '', get_term($ing)->name); ?>
                                                    <?php $string .= str_replace(['<p>', '</p>'], '', $description) ?? '' ?>
                                                    <?php $string .=  $ik === array_key_last($objProd->ingredientes) ? "" : ", "; ?>

                                                <?php endforeach; ?>
                                                
                                                <?php
                                                $palavrasEspeciais = array("Açúcar");

                                                foreach ($palavrasEspeciais as $palavra) {
                                                    $string = preg_replace('/\b' . preg_quote($palavra, '/') . '\b/i', '<span class="text-lowercase">' . lcfirst($palavra) . '</span>', $string);
                                                }
                                                
                                                $pattern = '/\b[A-ZÁÉÍÓÚÂÊÔÃÕÀÃÇ]+\b/u';
                                                preg_match_all($pattern, $string, $matches);

                                                if (!empty($matches[0])) {
                                                    // Se palavras em maiúsculas forem encontradas, substitua-as por <span> com classe "uppercase".
                                                    foreach ($matches[0] as $match) {
                                                        $string = preg_replace('/\b' . preg_quote($match, '/') . '\b/', '<span class="text-uppercase">' . $match . '</span>', $string, 1);
                                                    }
                                                }

                                                // Exiba a string resultante.
                                                ?>

                                                <?= $string; ?>

                                            </p>
                                            
                                                <strong style="color: var(--paragraph-color);"><?= nl2br($objProd->observacao) ?? ""; ?></strong>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item mb-2">
                                    <h3 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <i class="fa fa-plus pe-2"></i> Tabela Nutricional
                                        </button>
                                    </h3>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionProduto">
                                        <div class="accordion-body px-0">
                                            <?php
                                            if(!isset($objProd->porcao_de_referencias_0_porcao_de_referencia)):
                                            ?>
                                            <table class="table table-responsive">
                                                <thead>
                                                    <tr class="text-center porcao">
                                                        <th colspan="6"><?= $objProd->porcao_de_referencia ?? ""; ?></th>
                                                    </tr>
                                                    <tr class="header">
                                                        <th>Quantidade por porção</th>
                                                        <th></th>
                                                        <th class="text-end">%VD*</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php for ($i = 0; $i < $objProd->quantidade_e_valor_diario; $i++) : ?>
                                                        <tr>
                                                            <td><?= $objProd->{"quantidade_e_valor_diario_" . $i . "_item"} ?? ""; ?></td>
                                                            <td><?= $objProd->{"quantidade_e_valor_diario_" . $i . "_valor_do_item"} ?? ""; ?></td>
                                                            <td class="text-end"><?= $objProd->{"quantidade_e_valor_diario_" . $i . "_valor_diario%vd"} ?? ""; ?></td>
                                                        </tr>
                                                    <?php endfor; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="6" class="border-0">
                                                            <small>
                                                                <?= get_field('aviso_base_valor_diario', get_the_ID()) ?? '* % Valores Diários com base em uma dieta de 2000 kcal ou 8400 KJ. Seus valores diários podem ser maiores ou menores dependendo de suas necessidades energéticas.
                                                                **VD não estabelecido' ?>

                                                            </small>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <?php
                                            endif;

                                            if(isset($objProd->porcao_de_referencias_0_porcao_de_referencia)):
                                            ?>
                                             <!-- NOVA TABELA NUTRICIONAL INICIO --> 
                                            <table class="table table-responsive">
                                                <thead>
                                                    <tr class="text-center porcao">
                                                      
                                                        <th colspan="6"><?= $objProd->titulo_da_tabela_nutricional ?? "Porção ".$objProd->porcao_de_referencias_0_porcao_de_referencia; ?></th>
                                                         
                                                    </tr>
                                                    <tr class="header">
                                                        <th>Quantidade por porção</th>
                                                        
                                                        <?php
                                                     
                                                        for($i=0; $i < $objProd->porcao_de_referencias; $i++):
                                                            echo '<th>'.$objProd->{"porcao_de_referencias_" . $i . "_porcao_de_referencia"} ?? "".'</th>';
                                                        endfor;
                                                       
                                                        ?>
                                                        <th class="text-end">%VD*</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php for ($i = 0; $i < $objProd->quantidades_e_valores_diarios; $i++) : ?>
                                                        <tr>
                                                            <td><?= $objProd->{"quantidades_e_valores_diarios_" . $i . "_item"} ?? ""; ?></td>
                                                            <?php
                                                     
                                                            for($x=0; $x < (int)$objProd->{"quantidades_e_valores_diarios_" . $i . "_valor_dos_items"}; $x++):
                                                                
                                                                ?>
                                                                <td class="text-center"><?= $objProd->{"quantidades_e_valores_diarios_" . $i . "_valor_dos_items_". $x . "_valor_do_item"} ?? ""; ?></td>
                                                                <?php
                                                            endfor;
                                                       
                                                            ?>
                                                            <td class="text-end"><?= $objProd->{"quantidades_e_valores_diarios_" . $i . "_valor_diario%vd"} ?? ""; ?></td>
                                                        </tr>
                                                    <?php endfor; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="6" class="border-0">
                                                            <small>
                                                                <?= get_field('aviso_base_valor_diario', get_the_ID()) ?? '* % Valores Diários com base em uma dieta de 2000 kcal ou 8400 KJ. Seus valores diários podem ser maiores ou menores dependendo de suas necessidades energéticas.
                                                                **VD não estabelecido' ?>

                                                            </small>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <?php
                                            endif;
                                            ?>
                                            <!-- NOVA TABELA NUTRICIONAL FIM -->
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item mb-2">
                                    <h3 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="fa fa-plus pe-2"></i> Conservação
                                        </button>
                                    </h3>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionProduto">
                                        <div class="accordion-body px-0">
                                            <p>
                                                <!-- <?= $objProd->instrucoes_de_conservacao ?? ""; ?> -->
                                                CONSERVAR A -18ºC OU MAIS FRIO. DATA DE VALIDADE E LOTE: VIDE EMBALAGEM
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-6 d-none d-xl-block">
                            <!-- <img src="<?php // get_the_post_thumbnail_url($objProd->ID) ?? ""; ?>" class="img-fluid" alt="Manifesto"> -->
                            <img src="<?= !empty(get_field('imagem_de_destaque', $objProd->ID)) ? get_field('imagem_de_destaque', $objProd->ID) : get_the_post_thumbnail_url($objProd->ID) ?? ""; ?>" class="img-fluid" alt="Manifesto">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include_once "templates/sabor-que-nutre.php"; ?>

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
                                                    <h2 class="mt-2"><?= $prod->post_title ?? ""; ?></h2>
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

    <?php include_once "templates/receitas.php"; ?>
</main>
<?php include_once "templates/partials/footer.php"; ?>

<?php
// echo '<pre id="pre-test" style="display:none">';
// print_r($objProd);
// echo '</pre>';

?>