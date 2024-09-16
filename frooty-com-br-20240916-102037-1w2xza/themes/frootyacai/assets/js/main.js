document.addEventListener('DOMContentLoaded', function() {
    // Masks
    $('.phone').length > 0 ?
        $('.phone').mask('(00) 00000-0000') : null;

    $('.cep').length > 0 ?
        $('.cep').mask('00000-000') : null;

    $('.cnpj').length > 0 ?
        $('.cnpj').mask('00.000.000/0001-25') : null;

    // Slide produtos Home
    $('#slide-produtos-home').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        arrows: true,
        responsive: [
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true
                }
            }
        ]
    });
    // Slide Depoimentos
    $('#slide-depoimentos').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        responsive: [
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    height: '100px'
                }
            }
        ]
    });

    // Tabs receitas
    $(".receitas ul li").on('click', function() {
        $(".receitas ul li, .tab").removeClass("active");
        $(this).addClass('active');
        const tab = $(this).data('tab');
        $("#"+tab).addClass("active");
    });

    // Tabs contato
    $("#forms .pill").on("click", function(){
        $("#forms .pill, #forms form").removeClass('active');
        const targetId = $(this).data('form');

        $(this).addClass('active');
        $('#' + targetId).addClass('active');
    });

    // Menu Mobile - Open
    $('#trigger-menu').on('click', function(){
        $('header nav').animate({right: '0'});
    });
    // Menu Mobile - Close
    $('#trigger-close-menu').on('click', function(){
        $('header nav').animate({right: '-1000px'});
    });

    $('#search-modal').on('mouseleave',function () {
        $('header nav').animate({ 'right': '0px' });
    });

    // Atribui o nome do arquivo inserido em um input type file
    $('input[type="file"]').change(function(e) {
        var fileName = e.target.files[0].name;
        $(".file-name").val(fileName);
    });

})

document.addEventListener('DOMContentLoaded', function() {
    $('form.request').on('submit', function() {
        const url = $(this).attr("action");
        var form = new FormData($(this)[0]);

        $.ajax({
            type: "POST",
            url,
            data: form,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('body').loading({message: "Enviando..."});
            },
            success: function(rs) {
                if(rs === 200) {
                    Swal.fire(
                        'Mensagem enviada!',
                        'Obrigado por entrar em contato, responderemos o mais breve possível.',
                        'success'
                    );
                    $('input:not([type=hidden]), textarea').val("");
                    $('input[type=radio]').prop("checked", false);
                    $('textarea').text("");
                    $('body').loading("stop");


                    atualizarTokenRecaptcha();
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr);
                console.error(status);
                console.error(error);
                Swal.fire(
                    'Erro!',
                    'Ocorreu um erro ao enviar a mensagem. Por favor, tente novamente mais tarde.',
                    'error'
                );
                $('body').loading("stop");
            }
        });
        
        return false;
    })
});

// $(document).ready(function() {
//     $(".animsition").animsition({
//         inClass: 'fade-in',
//         outClass: 'fade-out',
//         inDuration: 800,
//         outDuration: 800,
//         linkElement: '.animsition-link',
//         // e.g. linkElement: 'a:not([target="_blank"]):not([href^="#"])'
//         loading: true,
//         loadingParentElement: 'html', //animsition wrapper element
//         loadingClass: 'animsition-loading',
//         loadingInner: '', // e.g '<img src="loading.svg" />'
//         timeout: false,
//         timeoutCountdown: 5000,
//         onLoadEvent: true,
//         // "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
//         // The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
//         overlay : false,
//         overlayClass : 'animsition-overlay-slide',
//         overlayParentElement : 'html',
//         transition: function(url){ window.location.href = url; }
//     });
// });