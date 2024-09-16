<?php include_once "templates/partials/header.php"; ?>
    <main id="error" class="mb-5">
        <section id="title">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-12 col-xl-8">
                        <div class="row m-0 p-0 h-100">
                            <div class="col-12 col-xl-4 my-auto text-center text-xl-start">
                                <h2 class="d-inline-block"> Eita! </h2>
                            </div>
                            <div class="col-12 col-xl-8 my-auto text-center text-xl-start">
                                <p>
                                    <span>Não encontramos a página que você estava procurando</span>. Enquanto volta para a página Home, que tal tomar um Frooty?
                                </p>
                            </div>
                            <div class="col-12 text-center text-xl-start">
                                <a href="<?= get_site_url(); ?>"><button class="button frooty-amarelo" type="button">Ir para a Home</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php include_once "templates/partials/footer.php"; ?>