<?php
include_once "templates/partials/header.php";
$postName = array_keys($_GET)[0];
$objCategoriaProdutos = get_terms('categoria__produtos', array('hide_empty' => false, "order" => "asc"));
$term = get_term_by('slug', $postName, 'categoria__produtos');
$objProd = get_posts([
    "post_type" => "produtos",
    "post_status" => "publish",
    "order" => "asc",
    "posts_per_page" => "1000000",
    "tax_query" => [
        'relation' => 'AND',
        array(
            'taxonomy' => 'categoria__produtos',
            'field' => 'slug',
            'terms' => $postName,
            'compare' => "IN"
        )
    ],
    "orderby" => "taxonomy",
    "taxonomy" => "categoria__tamanho"
]);
// function replaceCommas($string)
// {
//     return str_replace(',', '.', $string);
// }
// // Substitua as vírgulas por pontos nas medidas
// //$objProd->post_title = array_map('replaceCommas', $objProd->post_title);

// function customSort($a, $b)
// {
//     // Define a ordem das unidades
//     $unitOrder = ["ml", "l", "g", "kg"];

//     // Extrai os valores e unidades dos nomes
//     $a->post_title = str_replace(',', '.', $a->post_title);
//     $b->post_title = str_replace(',', '.', $b->post_title);

//     preg_match('/([0-9.]+)\s*([a-zA-Z]+)/', $a->post_title, $matchesA);
//     preg_match('/([0-9.]+)\s*([a-zA-Z]+)/', $b->post_title, $matchesB);

//     $valueA = (float) str_replace(',', '.', $matchesA[count($matchesA) - 2]);
//     $unitA = strtolower($matchesA[count($matchesA) - 1]);

//     $valueB = (float) str_replace(',', '.', $matchesB[count($matchesB) - 2]);
//     $unitB = strtolower($matchesB[count($matchesB) - 1]);

//     // Converte os valores de volume para litros
//     if ($unitA == "ml") {
//         $valueA /= 1000;
//     }

//     if ($unitB == "ml") {
//         $valueB /= 1000;
//     }

//     // Obtenha a ordem das unidades
//     $unitOrderA = array_search($unitA, $unitOrder);
//     $unitOrderB = array_search($unitB, $unitOrder);

//     if ($valueA < $valueB) {
//         return -1;
//     } elseif ($valueA > $valueB) {
//         return 1;
//     } else {
//         // Se os valores numéricos forem iguais, compare as unidades
//         if ($unitOrderA < $unitOrderB) {
//             return -1;
//         } elseif ($unitOrderA > $unitOrderB) {
//             return 1;
//         } else {
//             // Se as unidades são as mesmas, compare os nomes
//             if ($matchesA[0] < $matchesB[0]) {
//                 return -1;
//             } elseif ($matchesA[0] > $matchesB[0]) {
//                 return 1;
//             } else {
//                 return 0;
//             }
//         }
//     }
// }




// // Aplicar a função de classificação personalizada aos resultados
// usort($objProd, 'customSort');

// // Agora $objProd contém os resultados ordenados conforme sua especificação


?>
<main id="produtos" class="mb-5">
    <section id="title">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-start">
                    <h2><?= $term->name ?? ""; ?></h2>
                    <p>Conheça nossa linha <?= $term->name ?? ""; ?></p>
                </div>
            </div>
        </div>
    </section>


    <section id="container-produtos" class="slider-produtos">
        <div class="container">
            <div class="row h-100 justify-content-center">
                <div class="col-12 mt-5">
                    <h2 id="<?= $categoria->slug ?? ""; ?>" class="text-center"><?= $term->name ?? ""; ?></h2>
                </div>
                <?php

                // Suponha que você está trabalhando dentro do loop do seu custom post 'produto'.
                $taxonomy = 'categoria__tamanho';

                // Obtenha os termos da taxonomia com a ordenação personalizada.
                $terms = get_terms(array(
                    'taxonomy' => $taxonomy,
                    'orderby' => 'meta_value_num', // Ordenar por valor numérico do campo personalizado.
                    'meta_key' => 'ordem_exibicao', // Nome do campo personalizado ACF.
                    'order' => 'ASC', // Ordem ascendente.
                ));

                $ordered_terms = array(); // Array para armazenar os termos ordenados.

                foreach ($terms as $term) {
                    $ordered_terms[] = array(
                        'term_id' => $term->term_id,
                        'slug' => $term->slug,
                        'name' => $term->name,
                    );
                }

                // echo '<pre>';
                // var_dump($ordered_terms);
                // echo '</pre>';

                ?>
                <?php foreach ($ordered_terms as $pk => $tamanho) :

                    $objProd = get_posts([
                        "post_type" => "produtos",
                        "post_status" => "publish",
                        "order_by" => "date",
                        "order" => "asc",
                        "posts_per_page" => "-1",
                        "tax_query" => [
                            'relation' => 'AND',
                            array(
                                'taxonomy' => 'categoria__produtos',
                                'field' => 'slug',
                                'terms' => $postName,
                                'compare' => "IN"
                            ),
                            array(
                                'taxonomy' => 'categoria__tamanho',
                                'field' => 'slug',
                                'terms' => $tamanho["slug"],
                                'compare' => "IN"
                            )
                        ],
                        "orderby" => "taxonomy",
                        "taxonomy" => "categoria__tamanho"
                    ]);

                ?>


                    <?php foreach ($objProd as $pk => $prod) : ?>
                        <div class="col-6 col-md-4 col-xl-4 my-auto">
                            <figure class="text-center">
                                <a href="<?= get_site_url(); ?>/produto/<?= $prod->post_name ?? ""; ?>">
                                    <img class="img-fluid" src="<?= get_the_post_thumbnail_url($prod->ID); ?>" alt="">
                                </a>
                                <figcaption class="pb-5">
                                    <a href="<?= get_site_url(); ?>/produto/<?= $prod->post_name ?? ""; ?>">
                                        <?= $prod->post_title ?? ""; ?>
                                    </a>
                                    <a href="<?= get_site_url(); ?>/produto/<?= $prod->post_name ?? ""; ?>">
                                        <h2 class="mt-5 conhecer">Conhecer <i class="fa-solid fa-chevron-right"></i></h2>
                                    </a>
                                </figcaption>
                            </figure>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>

            </div>
            <div class="row h-100 justify-content-center my-5 py-5"></div>
        </div>
    </section>
</main>
<?php include_once "templates/partials/footer.php"; ?>