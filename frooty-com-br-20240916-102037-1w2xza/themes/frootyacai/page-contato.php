<?php
    include_once "templates/partials/header.php";
    $objPage = (object)acf_get_meta(14);
?>
    <main id="contato" class="mb-5">
        <section id="title">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-10">
                        <div class="row m-0 p-0 justify-content-center">
                            <div class="col-12 col-xl-6 text-center">
                                <h2><?= $objPage->titulo ?? ""; ?></h2>
                                <p><?= $objPage->subtitulo ?? ""; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="forms">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-3 col-xl-3 mb-3 mb-xl-0 text-center">
                        <div class="pill d-grid align-items-center active" onclick="document.getElementById('container').scrollIntoView();" data-form="consumidor">
                            <span>Sou Consumidor</span>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-xl-3 mb-3 mb-xl-0 text-center">
                        <div class="pill d-grid align-items-center" onclick="document.getElementById('container').scrollIntoView();" data-form="distribuidor">
                            <span>Sou Distribuidor</span>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-xl-3 mb-3 mb-xl-0 text-center">
                        <div class="pill d-grid align-items-center" onclick="document.getElementById('container').scrollIntoView();" data-form="parceiro">
                            <span>Quero Ser Parceiro</span>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-xl-3 mb-3 mb-xl-0 text-center">
                        <div class="pill d-grid align-items-center" onclick="document.getElementById('container').scrollIntoView();" data-form="trabalhe-conosco">
                            <span>Trabalhe Conosco</span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="container" class="container bg">
                <div class="row justify-content-center my-5">
                    <div class="col-12 col-xl-8 mt-5">
                        <form action="<?= get_site_url(); ?>/wp-json/wp/v2/send-contact-form" method="POST" id="consumidor" class="active request">
                            <input type="hidden" name="tipo" value="consumidor">
                            <input type="hidden" id="recaptchaToken" name="recaptchaToken">
                            <div class="form-group mb-4">
                                <input type="text" name="nome" class="form-control" placeholder="Nome Completo" value="" required>
                            </div>
                            <div class="form-group  mb-4">
                                <input type="email" name="email" class="form-control" placeholder="E-mail" value="" required>
                            </div>
                            <div class="form-group d-flex flex-row gap-4 mb-4">
                                <input type="text" name="telefone" class="form-control phone" placeholder="Telefone" value="" required>
                                <input type="text" name="cep" id="cep" class="form-control cep" placeholder="CEP" value="" required>
                            </div>
                            <div class="form-group d-flex flex-row gap-4 mb-4">
                                <input type="text" name="cidade" id="cidade" class="form-control" placeholder="Cidade" value="" required>
                                <input type="text" name="estado" id="uf" class="form-control" placeholder="Estado" value="" required>
                            </div>
                            <div class="form-group mb-4">
                                <input type="text" name="endereco" id="rua" class="form-control" placeholder="Endereço" value="" required>
                            </div>
                            <div class="form-group d-flex flex-row gap-4 mb-4">
                                <input type="text" name="numero" class="form-control" placeholder="Número" value="" required>
                                <input type="text" name="complemento" class="form-control" placeholder="Complemento" value="">
                            </div>
                            <div class="form-group mb-4">
                                <input type="text" name="assunto" class="form-control" placeholder="Assunto" value="" required>
                            </div>
                            <div class="form-group mb-4">
                                <textarea maxlength="255" name="mensagem" class="form-control" id="" placeholder="Mensagem: "></textarea>
                            </div>
                            <div class="form-group py-3">
                                <label for="aceite" class="radio">
                                    <input type="radio" name="aceite" id="aceite" value="Sim" required> <span>Declaro que aceito os termos da <strong><a href="https://dpo.privacytools.com.br/policy-view/aMZvBz5X4/1/poli%CC%81tica-de-privacidade/pt_BR?s=1637081524346" target="_blank"><u>Política de Privacidade</u></a></strong> do site.</span>
                                </label>
                            </div>
                            <div class="py-3">
                                <button type="submit" class="button frooty-pitaya">Enviar</button>
                            </div>
                        </form>

                        <form action="<?= get_site_url(); ?>/wp-json/wp/v2/send-contact-form" method="POST" id="distribuidor" class="request">
                            <input type="hidden" id="recaptchaToken" name="recaptchaToken">
                            <input type="hidden" name="tipo" value="distribuidor">
                            <div class="form-group mb-4">
                                <input type="text" name="nome" class="form-control" placeholder="Nome Completo" value="" required>
                            </div>
                            <div class="form-group  mb-4">
                                <input type="email" name="email" class="form-control" placeholder="E-mail" value="" required>
                            </div>
                            <div class="form-group d-flex flex-row gap-4 mb-4">
                                <input type="text" name="telefone" class="form-control phone" placeholder="Telefone" value="" required>
                                <input type="text" name="cep" id="cep" class="form-control cep" placeholder="CEP" value="" required>
                            </div>
                            <div class="form-group d-flex flex-row gap-4 mb-4">
                                <input type="text" name="cidade" id="cidade" class="form-control" placeholder="Cidade" value="" required>
                                <input type="text" name="estado" id="uf" class="form-control" placeholder="Estado" value="" required>
                            </div>
                            <div class="form-group mb-4">
                                <input type="text" name="endereco" id="rua" class="form-control" placeholder="Endereço" value="" required>
                            </div>
                            <div class="form-group d-flex flex-row gap-4 mb-4">
                                <input type="text" name="numero" class="form-control" placeholder="Número" value="" required>
                                <input type="text" name="complemento" class="form-control" placeholder="Complemento" value="">
                            </div>
                            <div class="form-group mb-4">
                                <textarea maxlength="255" name="mensagem" class="form-control" placeholder="Mensagem: "></textarea>
                            </div>
                            <div class="form-group py-3">
                                <label for="aceite_dist" class="radio">
                                    <input type="radio" name="aceite" id="aceite_dist" value="Sim" required> <span>Declaro que aceito os termos da <strong><a href="https://dpo.privacytools.com.br/policy-view/aMZvBz5X4/1/poli%CC%81tica-de-privacidade/pt_BR?s=1637081524346"><u>Política de Privacidade</u></a></strong> do site.</span>
                                </label>
                            </div>
                            <div class="py-3">
                                <button type="submit" class="button frooty-pitaya">Enviar</button>
                            </div>
                        </form>

                        <form action="<?= get_site_url(); ?>/wp-json/wp/v2/send-contact-form" method="POST" id="parceiro" class="request">
                            <input type="hidden" id="recaptchaToken" name="recaptchaToken">
                            <input type="hidden" name="tipo" value="parceiro">
                            <div class="form-group mb-4">
                                <input type="text" name="nome" class="form-control" placeholder="Nome do Responsável" value="" required>
                            </div>
                            <div class="form-group d-flex flex-row gap-4 mb-4">
                                <input type="text" name="razao_social" class="form-control" placeholder="Razão Social" value="">
                                <input type="text" name="cnpj" class="form-control cnpj" placeholder="CNPJ" value="">
                            </div>
                            <div class="form-group d-flex flex-row gap-4 mb-4">
                                <input type="email" name="email" class="form-control" placeholder="E-mail" value="" required>
                                <input type="text" name="telefone" class="form-control phone" placeholder="Telefone" value="" required>
                            </div>
                            <div class="form-group d-flex flex-row gap-4 mb-4">
                                <input type="text" name="cidade" class="form-control" placeholder="Cidade" value="" required>
                                <input type="text" name="estado" class="form-control" placeholder="Estado" value="" required>
                            </div>
                            <div class="form-group mb-4">
                                <textarea maxlength="255" name="mensagem" class="form-control" placeholder="Mensagem: "></textarea>
                            </div>
                            <div class="form-group py-3">
                                <label for="aceite_par" class="radio">
                                    <input type="radio" name="aceite" id="aceite_par" value="Sim" required> <span>Declaro que aceito os termos da <strong><a href="https://dpo.privacytools.com.br/policy-view/aMZvBz5X4/1/poli%CC%81tica-de-privacidade/pt_BR?s=1637081524346" target="_blank"><u>Política de Privacidade</u></a></strong> do site.</span>
                                </label>
                            </div>
                            <div class="py-3">
                                <button type="submit" class="button frooty-pitaya">Enviar</button>
                            </div>
                        </form>

                        <form action="<?= get_site_url(); ?>/wp-json/wp/v2/send-contact-form" enctype="multipart/form-data" method="POST" id="trabalhe-conosco" class="request">
                            <input type="hidden" name="tipo" value="trabalhe-conosco">
                            <input type="hidden" id="recaptchaToken" name="recaptchaToken">
                            <div class="form-group mb-4">
                                <input type="text" name="nome" class="form-control" placeholder="Nome Completo" value="" required>
                            </div>
                            <div class="form-group mb-4">
                                <input type="email" name="email" class="form-control" placeholder="E-mail" value="" required>
                            </div>
                            <div class="form-group d-flex flex-row gap-4 mb-4">
                                <input type="text" name="telefone" class="form-control phone" placeholder="Telefone" value="" required>
                                <input type="text" name="vaga" class="form-control" placeholder="Vaga de interesse" value="" required>
                            </div>
                            <div class="form-group d-flex flex-row gap-4 mb-4">
                                <input type="text" name="cidade" class="form-control" placeholder="Cidade" value="" required>
                                <input type="text" name="estado" class="form-control" placeholder="Estado" value="" required>
                            </div>
                            <div class="form-group mb-4">
                                <input type="file" name="anexo" id="anexo" class="form-control d-none" value="" required>
                                <input type="text" onclick="$('#anexo').click();" class="form-control file pointer file-name" placeholder="Anexar CV" >
                            </div>
                            <div class="form-group py-3">
                                <label for="aceite_trabalhe" class="radio">
                                    <input type="radio" name="aceite" id="aceite_trabalhe" value="Sim" required> <span>Declaro que aceito os termos da <strong><a href="https://dpo.privacytools.com.br/policy-view/aMZvBz5X4/1/poli%CC%81tica-de-privacidade/pt_BR?s=1637081524346"><u>Política de Privacidade</u></a></strong> do site.</span>
                                </label>
                            </div>
                            <div class="py-3">
                                <button type="submit" class="button frooty-pitaya">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </section>

        <section id="codigo-etica">
            <div class="container">
                <div class="row justify-content-center ">
                    <div class="col-11 col-xl-10 bg px-0 px-xl-5 mb-5">
                        <div class="row mt-5 mb-4">
                            <div class="col-12">
                                <h2 class="text-center"><?= $objPage->titulo_canal_de_denuncias ?? ""; ?></h2>
                            </div>
                        </div>
                        <div class="row m-0 p-0 justify-content-center mb-5">
                            <div class="col-12 text-center">
                                <p>
                                    <?= ucfirst(strtolower($objPage->texto_canal_de_denuncias)) ?? ""; ?>
                                 
                                 <!-- Para relatos de desvio de conduta, irregularidades, corrupção e demais ilicitudes às leis vigentes e ao nosso código de conduta ética, disponibilizamos um canal específico de utilização, diferente do SAC. Neste, todas as denúncias  serão registradas e tratadas de forma confidencial (sendo permitido o envio da denúncia de forma totalmente anônima).-->
                                <p>
                            </div>
                            <div class="col-12 text-center my-4">
                                <a href="<?= $objPage->cta_canal_de_denuncias["url"] ?? ""; ?>" target="<?= $objPage->cta_canal_de_denuncias["target"] ?? ""; ?>">
                                    <button class="button frooty-amarelo"><?= $objPage->cta_canal_de_denuncias["title"] ?? ""; ?></button>
                                </a>
                                <p class="mt-5">
									<?= nl2br($objPage->texto_observacoes) ?? ""; ?>
								</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php include_once "templates/partials/footer.php"; ?>