$(document).ready(function () {

    //Pagina actual
    $('body.eventos .navegacion a:contains("Eventos")').addClass('activo');
    $('body.revistas .navegacion a:contains("Revistas")').addClass('activo');

    //Barra fija
    var windowHeight = $(window).height();
    var barraAltura = $('.barra').innerHeight();

    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if(scroll > windowHeight){
            $('.barra').addClass('fixed');
            $('body').css({'margin-top': barraAltura + 'px'});
        }else {
            $('.barra').removeClass('fixed');
            $('body').css({'margin-top': '0px'});
        }
    });

    //Menu resposivo

    $('.menu-movil').on('click', function() {
        $('.navegacion').slideToggle();
    });

    //Menu evento
    $('.programa-evento .info-evento:first').show();
    $('.menu-evento a:first').addClass('activo');

    $('.menu-evento a').on('click', function() {
        $('.menu-evento a').removeClass('activo');
        $(this).addClass('activo');
        $('.ocultar').hide();
        var enlace = $(this).attr('href');
        $(enlace).fadeIn(1000);
        return false;
    });

    //Busqueda
    $('#buscar_categoria').on('change', function(){
        //event.preventDefault(); // cambiarlo! -> e
        var sistema = getUrl();
        //alert(sistema); 
        //window.location.href= $(this).val();
        window.location.href = sistema + 'buscar_evento.php?categoria=' +$(this).val();
       
    });
    $('#buscar_area').on('change', function(){
        //event.preventDefault(); // cambiarlo! -> e
        var sistema = getUrl();
        var file = filename();
        //alert(sistema); 
        //window.location.href= $(this).val();
        //
        if(file == "eventos.php"){
            window.location.href = sistema + 'buscar_evento.php?area=' +$(this).val();
        }
        if(file == "revistas.php"){
            window.location.href = sistema + 'buscar_revista.php?area=' +$(this).val();
        }
       
    });
});

function getUrl() {
    var loc = window.location;
    var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
    return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
}

function filename(){
    var rutaAbsoluta = self.location.href;   
    var posicionUltimaBarra = rutaAbsoluta.lastIndexOf("/");
    var rutaRelativa = rutaAbsoluta.substring( posicionUltimaBarra + "/".length , rutaAbsoluta.length );
    return rutaRelativa;  
}
// Programa de conferencias

