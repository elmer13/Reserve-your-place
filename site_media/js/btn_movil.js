$(function() {

    var btn_movil = $('#nav-mobile'),
    
    menu = $('.menutop').find('ul'); // Dentro de la clase encapsulara los elementos que contenga 'ul'


    // Al dar click agregar/quitar clases que permiten el despliegue del menú
    btn_movil.on('click', function (e) {
        e.preventDefault();

        var el = $(this);

        el.toggleClass('nav-active'); 
        menu.toggleClass('open-menu'); // Abrimos el menú

    })

});