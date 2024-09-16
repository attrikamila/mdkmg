<?php
$objChamadas = (object)acf_get_meta(431);
?>
<section id="sabor-que-nutre">
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-11 col-xl-10 bg px-0 px-xl-5">
                <div class="row mt-5 mb-4">
                    <div class="col-12">
                        <h2 class="text-center"><strong><?= $objChamadas->titulo_sabor ?? ""; ?></strong></h2>
                    </div>
                </div>
                <div class="row m-0 p-0 justify-content-center">
                    <div class="col-12 col-xl-8 text-center">
                        <p>
                            <?= nl2br($objChamadas->texto_sabor) ?? ""; ?>
                        </p>
                    </div>
                    <div class="col-12 text-center my-4">
                        <a href="<?= $objChamadas->cta_sabor["url"] ?? ""; ?>" target="<?= $objChamadas->cta_sabor["target"] ?? ""; ?>">
                            <button class="button frooty-graviola"><?= $objChamadas->cta_sabor["title"] ?? ""; ?></button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>