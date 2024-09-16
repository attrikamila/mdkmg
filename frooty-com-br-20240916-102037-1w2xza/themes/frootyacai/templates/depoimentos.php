<?php
$objDepoimentos = get_posts([
    "post_type" => "depoimentos",
    "post_status" => "publish",
    "order" => "desc",
    "posts_per_page" => "-1"
]);
?>
<section class="depoimentos">
    <div class="container">
        <div class="row bg-white rounded-5 justify-content-center h-100" id="slide-depoimentos">
            <?php foreach ($objDepoimentos as $dk => $depoimento): ?>
                <?php $depoimento->meta = (object)acf_get_meta($depoimento->ID); ?>
                <div class="col-12 col-xl-10 my-auto py-1 px-xl-5">
                    <figure class="text-center">
                        <img src="<?= get_template_directory_uri(); ?>/assets/img/comments.png" class="my-3" alt="Depoimento">
                        <figcaption>
                            <h2 class="text-center my-3"><?= $depoimento->post_content ?? ""; ?></h2>
                            <p class="mt-5"><strong><?= $depoimento->meta->nome ?? ""; ?></strong> <span class="ps-3"><?= $depoimento->meta->cargo ?? ""; ?></span></p>
                        </figcaption>
                    </figure>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
