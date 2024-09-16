<?php
include_once "templates/partials/header.php";
$objPage = (object)acf_get_meta(22);
$objPoliticas = get_posts([
    "post_type" => "politicas",
    "post_status" => "publish",
    "order" => "asc",
    "posts_per_page" => "-1",
]);
?>
    <main id="codigo-politicas">
        <section id="title">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-10 text-center">
                    <h2>Relatórios de transparência e igualdade salarial</h2>
                    </div>
                </div>
            </div>
        </section>

        <section id="politicas">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10">
                    <p style="color: var(--frooty-roxo); font-size: var(--titles); font-weight: 600 !important;"> Em cumprimento à Lei nº 14.611 de 04 de Julho de 2023, à Portaria MTE Nº 3.714 ao Decreto nº 11.795/2023, bem como nosso compromisso com a promoção de práticas de inclusão e diversidade, divulgamos o relatório de transparência e igualdade salarial.</p>
<p>É importante saber que a CBO (Classificação Brasileira de Ocupações) é um sistema que organiza e ¹classifica as profissões existentes no Brasil, tendo sido utilizada como base para elaboração do relatório.Ela serve para:</p>
<p> - Identificar e nomear profissões;</p>
<p> - Descrever, de forma geral e ampla, as atividades que cada profissão realiza;</p>
<p> - Informar os requisitos, formações acadêmicas e experiências necessárias mais utilizados no mercado de trabalho².</p>
<p> Para que é utilizado:</p>
<p> - Buscar informações sobre profissões;</p>
<p> - Auxiliar empresas a classificar cargos e funções (e-Social e Caged);</p>
<p> - Pesquisas públicas de mercado de trabalho;</p>
<p> - Políticas públicas de emprego e qualificação profissional.</p>
<p> Os dados dos relatórios estão anonimizados conforme a Lei Geral de Proteção de Dados Pessoais - LGPD 13 709/2018. As informações foram agrupadas pelo Ministério do Trabalho e Emprego de acordo com os Grandes Grupos da CBO (Classificação Brasileira de Ocupações).</p>
<p> Grandes Grupos: É uma classificação do governo que reúne diferentes tipos de trabalho (cargos/departamentos).</p>
<p> (1) Reconhecimento para fins classificatórios, sem função de regulamentação profissional.</p>
<p> (2) Não traduz a realidade para todos as cargos.</p>
                    </div>
                
                    <div class="col-12 col-lg-10 d-flex gap-2">
                    
                    <a class="button frooty-roxo pitaya mt-4 mt-xl-0" target="_blank" href="https://frooty.com.br/relatorio_transparencia_salarial/Relatório de Transparencia Salarial 1o. Semestre de 2024 Mocajuba.pdf">Mocajuba <i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a>
                    <a class="button frooty-roxo pitaya mt-4 mt-xl-0" target="_blank" href="https://frooty.com.br/relatorio_transparencia_salarial/Relatório de Transparencia Salarial 1o. Semestre de 2024 Matriz.pdf">Matriz <i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a>
                    <a class="button frooty-roxo pitaya mt-4 mt-xl-0" target="_blank" href="https://frooty.com.br/relatorio_transparencia_salarial/Relatório de Transparencia Salarial 1o. Semestre de 2024 PCA.pdf">PCA <i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </section>
    <style>

a.button.frooty-roxo {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 50px;
}

    </style>
        <section id="container-contato">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-10 bg">
                        <h2 class="mb-4"><?= nl2br($objPage->titulo_do_formulario) ?? ""; ?></h2>
                        <p class="mb-5"><?= nl2br($objPage->texto_formulario) ?? ""; ?></p>

                        <form action="<?= get_site_url(); ?>/wp-json/wp/v2/send-contact-form" method="POST" class="request">
                            <input type="hidden" name="tipo" value="consumidor">
                            <div class="form-group mb-3">
                                <input type="text" name="nome" placeholder="Nome completo" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="email" name="email" placeholder="E-mail" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" name="telefone" placeholder="Telefone" class="form-control phone" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="aceite" class="radio">
                                    <input type="radio" id="aceite" name="aceite" value="Sim" required> <span>Declaro que aceito os termos da <a href="">Política de Privacidade</a> do site.</span>
                                </label>
                            </div>

                            <button type="submit" class="button frooty-pitaya mt-3">Enviar</button>
                        </form>
                    </div>
                </div>
                <div class="row my-5 py-5"></div>
            </div>
        </section>
    </main>
<?php include_once "templates/partials/footer.php"; ?>