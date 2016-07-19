$(document).ready(function () {
    var url = $.url();
    $("#btnbuscar").click(function () {
        $("#bootpag_text_count").submit();

    });
    $("#bootpag_text_count_select").change(function () {
        $("#bootpag_text_count").submit();
    });

    if (url.param('sa') != null) {
        $('#bootpag_text_param').val(url.param('sa'));
    }
    if (url.param('numpp') != null) {
        $('#bootpag_text_count_select').val(url.param('numpp'));
    }

    /*Usuarios*/
    if (url.param('tipousuario') != null) {
        $('#tiposusuarios').val(url.param('tipousuario'));
    }
    $("#tiposusuarios").change(function () {
        $("#bootpag_text_count").submit();
    });


    /*Producto*/
    if (url.param('tipoproducto') != null) {
        $('#tiposproductos').val(url.param('tipoproducto'));
    }
    $("#tiposproductos").change(function () {
        $("#bootpag_text_count").submit();
    });


    /*Notificaciones*/
    if (url.param('tiponotificacion') != null) {
        $('#tiposnotificaciones').val(url.param('tiponotificacion'));
    }
    $("#tiposnotificaciones").change(function () {
        $("#bootpag_text_count").submit();
    });

    /*Puntos de venta*/
    if (url.param('estado') != null) {
        $('#estados').val(url.param('estado'));
    }
    $("#estados").change(function () {
        $("#bootpag_text_count").submit();
    });
    if (url.param('statuspunto') != null) {
        $('#statuspunto').val(url.param('statuspunto'));
    }
    $("#statuspunto").change(function () {
        $("#bootpag_text_count").submit();
    });
    
    if (url.param('date_ini') != null) {
        $('#date_ini').val(url.param('date_ini'));
    }
   
    if (url.param('date_fin') != null) {
        $('#date_fin').val(url.param('date_fin'));
    }


    setNavigation();
    getBootPage();
    selectCountSelect();
});
function setNavigation() {
    var path = window.location.pathname;
    path = path.replace(/\/$/, "");
    path = decodeURIComponent(path);
    $(".nav-sidebar a").each(function () {
        var href = $(this).attr('href');
        if (path == href) {
            $(this).parent().addClass('active');
        }
    });
}
function getBootPage() {
    var url = $.url();
    var current = (url.param('page') == null) ? 1 : url.param('page');
    var count = $('#bootpag_pag').attr('data-count');
    var numpp = (url.param('numpp') == null) ? 10 : url.param('numpp');
    count = (count % numpp == 0) ? Math.floor(count / numpp) : Math.floor(count / numpp) + 1;
    $('#bootpag_pag').bootpag({
        total: count,
        page: current,
        maxVisible: 4,
        leaps: true,
        firstLastUse: true,
        first: '<',
        last: '>',
        wrapClass: 'pagination',
        activeClass: 'active',
        disabledClass: 'disabled',
        nextClass: 'next',
        prevClass: 'prev',
        lastClass: 'last',
        firstClass: 'first'
    }).on("page", function (event, num) {
        $("#current_page").val(num);
        $("#bootpag_text_count").submit();
    });
}
function selectCountSelect() {
    var url = $.url();
    var selec = (url.param('numpp') == null) ? 10 : url.param('numpp');
    $("#bootpag_text_count_select").val(selec);
}