$(document).ready(function(){
    
    /* Cambia el lenguaje del datepicker a español */
        $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '',
            nextText: '',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
            weekHeader: 'Sm',
            dateFormat: 'yy/mm/dd',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['es']);

    try{

        var moment = require('moment');
        $("#selectFuente").select2({
          allowClear: true
        });

        moment.updateLocale('en', {
            longDateFormat : {
                LTS: "HH:mm:ss"
            }
        });

        $(function () {
            var $input = $('.relojd');
            $input.datetimepicker({
                format: 'LTS'
            });
        });

        getTimeHour();
        function getTimeHour(){

            var hour = new Date();
            $('.required-hour').val(hour.toLocaleTimeString());
        } 

    }catch(e){
        console.log(e);
    }

    try
    {
        // Summernote
        $('#summernote').summernote({
            height: 200
        });
    }
    catch( err )
    {
        console.log( err );
    }
    
    $(".select2").select2({
      allowClear: true
    });    
    
    $(function() {
        $('.date_time').datetimepicker({
          pickDate: false
        });
    });

    $('.fechaNota').datepicker({
    dateFormat: 'yy-mm-dd',
    startDate: '-3d'
    });


    /* Filtro clientes envia correo */
    jQuery('input.filtro-clientes').on('keyup', function(event) {
        event.preventDefault();
        var criterio = jQuery(this).val();
        var noticia = $(this).data('noticiaid');
        if( criterio.length >= 3 || jQuery.isNumeric( criterio ) ){
            jQuery.post('/panel/new/send/client/filter', {'criterio':criterio, 'noticiaid':noticia}, function(json) {
              jQuery('.resultados.clientes tbody').html(json.html);
              jQuery('.resultados.clientes').show();
            },'json');
        }
        else{
            jQuery('.resultados.clientes').hide();
        }
    });

    /* Trae las secciones de acuerdo a la fuente seleccionada */
    $( '#selectFuente' ).change( function (){
        $( '#selectFuente option:selected' ).each( function () {
            var $elegido = $(this).val();
            $.get( '/panel/get/seccion/' + $elegido, function (data) {
                var $ssecction = $('#add-new-secction');
                $ssecction.removeAttr('disabled');
                $('option', $ssecction).remove();
                if( typeof(data) == 'string' ){
                    $ssecction.append('<option value="">Sección</option>');
                    $ssecction.append('<option value="">' + data + '</option>');
                }else{
                    $ssecction.append('<option value="">Sección</option>');                    
                    $.each( data, function (i, item){
                        $ssecction.append( $('<option>', {
                            value: item.id_seccion,
                            text : item.nombre                            
                        } ) );
                    } );
                }                
            } );
        });
    });

    /** Reportes */
    /* Trae los temas de una empresa para los reportes*/
    $( '#empresa' ).change( function (){
        $( '#empresa option:selected' ).each( function () {
            var $elegido = $(this).val();
            $.get( '/panel/get/temas/' + $elegido, function (data) {
                var $stema = $('#tema');
                $stema.removeAttr('disabled');
                $('option', $stema).remove();
                if( typeof(data) == 'string' ){
                    $stema.append('<option value="">Tema</option>');
                    $stema.append('<option value="">' + data + '</option>');
                }else{
                    $stema.append('<option value="">Tema</option>');                    
                    $stema.append('<option value="0">Todos los temas</option>');                    
                    $.each( data, function (i, item){
                        $stema.append( $('<option>', {
                            value: item.id_tema,
                            text : item.nombre                            
                        } ) );
                    } );
                }                
            } );
        });
    });
    /* Trae las fuentes de un tipo de fuente */
    $( '#tipo_fuente' ).change( function (){
        $( '#tipo_fuente option:selected' ).each( function () {
            var $elegido = parseInt($(this).val());
            if($elegido != 0 || $elegido != '')
            {
                $.get( '/panel/fonts/fonts-by-type/' + $elegido, function (data) {
                    var $sfuente = $('#fuente');
                    $sfuente.removeAttr('disabled');
                    $('option', $sfuente).remove();                
                    $sfuente.append('<option value="">Fuente</option>');                    
                    $sfuente.append('<option value="0">Todas las fuentes</option>');                    
                    $.each( data, function (i, item){
                        $sfuente.append( $('<option>', {
                            value: item.id_fuente,
                            text : item.nombre                            
                        } ) );
                    } );                
                } );                
            }
        });
    });

    /* Obtiene las secciones de una fuente */
    $( '#fuente' ).change( function (){
        $( '#fuente option:selected' ).each( function () {
            var $elegido = parseInt($(this).val());
            if($elegido != 0 || $elegido != '')
            {
                $.get( '/panel/get/seccion/' + $elegido, function (data) {
                    var $sseccion = $('#seccion');
                    $sseccion.removeAttr('disabled');
                    $('option', $sseccion).remove();
                    if(typeof(data) == 'string'){
                        $sseccion.append('<option value="">Sección</option>');
                        $sseccion.append('<option value="">' + data + '</option>');  
                    }else{
                        $sseccion.append('<option value="">Sección</option>');                    
                        $sseccion.append('<option value="0">Todas las secciones</option>');                    
                        $.each( data, function (i, item){
                            $sseccion.append( $('<option>', {
                                value: item.id_seccion,
                                text : item.nombre                            
                            } ) );
                        } );
                    }                
                } );                
            }
        });
    });
    /** Fin Reportes */

    // Agregar un autor si la seccion lo tiene al momento de agregar una noticia
    $('#add-new-secction').change( function(){

        var $seccion = $(this).val();
        
        $.get( '/panel/seccion/autor/' + $seccion, function( autor ){
            
            $('#autor').val(autor);
            
        } );
    });

    /* Para el bloque de noticias */
    
    //muestra el area para agregar una noticia al un bloque
    $('#checkBlock').change(addNewBlock);
    
    function addNewBlock(){
        var $checkBlock = $('#checkBlock');
        var $panelBlock = $('#panelBloque');
        if( $checkBlock.prop('checked')){
            $panelBlock.removeClass('invisible');
        }else{
            $panelBlock.addClass('invisible');
        }
    }

    // Selecciona un tema
    $( '.select-bloque' ).change( function (){
        $( '.select-bloque option:selected' ).each( function () {
            var $elegido = $(this).val();
            var empresa = $(this).data('empresa');
            $.get( '/panel/get/temas/' + empresa, function (data) {
                var $stema = $('.select-tema');
                $stema.removeAttr('disabled');
                $('option', $stema).remove();
                if( typeof(data) == 'string' ){
                    $stema.append('<option value="">Seleccione un tema</option>');
                    $stema.append('<option value="">' + data + '</option>');
                }else{
                    $stema.append('<option value="">Seleccione un tema</option>');                    
                    $.each( data, function (i, item){
                        $stema.append( $('<option>', {
                            value: item.id_tema,
                            text : item.nombre                            
                        } ) );
                    } );
                }                
            } );
        });
    });

    //activa el boton de guardar
    $( '.select-tema' ).change( function() {
        $('#btn-guardar-tema').removeClass('disabled');
    });

    /* Para crear un bloque */ 

    //Submit crear bloque
    $('#form-block').validate({
        submitHandler: function (form){
            var $formulario = $(form);
            var datos = $formulario.serialize();
            $.post($formulario.attr('action'), datos, function (json) {
                if (json.exito) {
                    var $alert = $('.alert');
                    $alert.addClass(json.tipo).html(json.mensaje).delay(3000).fadeOut('slow', function() {
                        window.location = '/panel/news/blocks';
                    });
                }
            });
        }
    });


    /** Para editar un bloque */
    //Activar formulario de edicion
    $('#block-edit').on('click', activarFormularioEditar);
    
    //Descativar formulario de edicion
    $('#block-cancel').on('click', desactivarFormularioEditar);

    //Activar formulario para agregar una noticia al bloque
    $('#block-add-new').on('click', activarAgregarNoticia);

    //Desactivar formulario para agregar una noticia al bloque
    $('#block-save').on('click', desactivarAgregarNoticia);

    //Activar formulario para seleccionar contactos
    $('#block-contactos-btn').on('click', activarSeleccionarContactos);

    //Cancelar envio
    $('#block-contactos-cancela').click(function(){
        window.location.reload();
    });

    //Cancelar envio
    $('.checkbox-todos').change(function(){
        var $checkboxs = $(".checkbox-active input[type=checkbox]");
        if ($(this).is(':checked')) {
            $checkboxs.prop('checked', true);
        }else{
            $checkboxs.prop('checked', false);
        }
    });
    
    function activarFormularioEditar(){
        var $botonCancelar = $('#block-cancel');
        var $botonEditar = $('#block-edit');
        var $fields = $('#form-block-edit fieldset');
        var $formulario = $('#form-block-edit');

        $botonCancelar.removeClass('invisible');
        $botonEditar.addClass('invisible');
        $formulario.removeClass('invisible');
        $fields.removeAttr('disabled');
    }
    
    function desactivarFormularioEditar(){
        var $botonCancelar = $('#block-cancel');
        var $botonEditar = $('#block-edit');
        var $fields = $('#form-block-edit fieldset');
        var $formulario = $('#form-block-edit');

        $botonEditar.removeClass('invisible');
        $botonCancelar.addClass('invisible');
        $formulario.addClass('invisible');
        $fields.attr('disabled', 'disabled');
    }

    function activarAgregarNoticia(){
        var $botonGuardar = $('#block-save');
        var $botonAgregar = $('#block-add-new');
        var $fields = $('#block-form-add-new fieldset');
        var $formulario = $('#block-form-add-new');

        $botonGuardar.removeClass('invisible');
        $botonAgregar.addClass('invisible');
        $formulario.removeClass('invisible');
        $fields.removeAttr('disabled');
    }

    function desactivarAgregarNoticia(){
        var $botonGuardar = $('#block-save');
        var $botonAgregar = $('#block-add-new');
        var $fields = $('#block-form-add-new fieldset');
        var $formulario = $('#block-form-add-new');

        $botonGuardar.addClass('invisible');
        $botonAgregar.removeClass('invisible');
        $formulario.addClass('invisible');
        $fields.attr('disabled', 'disabled');
    }

    //activar formulario para seleccionar contactos
    function activarSeleccionarContactos(){
        // console.log('ouch');
        var $fields = $('#active-form-contacs');
        var $panelContactos = $('.row.panel-green');

        $panelContactos.removeClass('invisible');
        $fields.removeAttr('disabled');
    }
    //Submit editar bloque
    $('#form-block-edit').validate({
        submitHandler: function (form){
            var $formulario = $(form);
            var datos = $formulario.serialize();
            $.post($formulario.attr('action'), datos, function (json) {
                if (json.exito) {
                    var $alert = $('.alert');
                    $alert.addClass(json.tipo).html(json.mensaje).delay(3000).fadeOut('slow', function() {
                        window.location.reload();
                    });
                    $formulario.fadeOut('slow');
                }
            });
        }
    });

    //Submit enviar bloque
    $('#form-send-block').validate({
        submitHandler: function (form){
            var $formulario = $(form);
            var datos = $formulario.serialize();
            var $checkboxs = $(".checkbox-active input[type=checkbox]:checked");
            if( $checkboxs.length === 0){
                alert('Debe seleccionar al menos un contacto');
            }else{
                $.post($formulario.attr('action'), datos, function (json) {
                    if (json.exito) {
                        var $alert = $('.alert');
                        $alert.addClass(json.tipo).html(json.mensaje).delay(3000).fadeOut('slow', function() {
                            window.location.reload();
                        });
                        $formulario.fadeOut('slow');
                    }
                });                
            }
        }
    });

    //Agregar una noticia a un bloque
    $('.block-save').click(function( event ) {
        var boton = $(this);
        var $alert = $('.alert');
        event.preventDefault();
        var data = {};
        data.noticia = $(this).data('noticia');
        data.bloque = $(this).data('bloque');
        // data.tema = $('.addThemeBlock').val();
        data.tema = $(this).parent().parent().find('td .addThemeBlock').val();
        $.post('/panel/block/add-new', data, function(json){
            if (json.exito) {
                $alert.removeClass(json.tipo);
                $alert.removeAttr('style');
                $alert.addClass(json.tipo).html(json.mensaje).delay(3000).fadeOut('slow', function(){
                    boton.parent().parent().fadeOut('slow');                    
                });
            }else{
                $alert.removeAttr('style');
                $alert.addClass(json.tipo).html(json.mensaje).delay(3000).fadeOut('slow');
            }
        });
    });

    //elimina una noticia del bloque de noticias
    $('.block-remove-new').click(function( event ){
        event.preventDefault();
        var boton = $(this);
        var data = {};
        var $alert = $('.alert');
        var $modal = $('#myModal');
        var $eliminar = $modal.find('.modal-footer .btn-primary');
        $modal.find('#myModalLabel').html('Eliminar Noticia del Bloque');
        $modal.find('.modal-body').html('Esta seguro que decea eliminar esta noticia.');
        $eliminar.html('Eliminar');
        data.bnid = $(this).data('bn');
        $eliminar.click(function(){
            $.post('/panel/block-new/delete', data, function(json){
                if (json.exito) {
                    $modal.modal('toggle');
                    $alert.removeClass(json.tipo);
                    $alert.removeAttr('style');
                    $alert.addClass(json.tipo).html(json.mensaje).delay(3000).fadeOut('slow', function(){
                        boton.parent().fadeOut('slow');
                        window.location.reload();
                    });
                }
            });            
        });
    });

    //Cambia el estado de una seccion en una fuente
    $('.change-state').click(function( e ){
        e.preventDefault();
        var $href = $(this).data('href');
        var $alert = $('.alert');
        var $modal = $('#myModal');
        var $state = $modal.find('.modal-footer .btn-primary');
        $modal.find('#myModalLabel').html('Va ha cambiar el estado de esta sección');
        $modal.find('.modal-body').html('Esta seguro que decea cambiar el estado de la sección.');
        $state.html('Cambiar');
        // debugger;
        $state.click(function(){
            $.get($href, function(json){
                if (json.exito) {
                    $modal.modal('toggle');
                    $alert.removeClass(json.class);
                    $alert.removeAttr('style');
                    $alert.addClass(json.class).html(json.text).delay(3000).fadeOut('slow', function(){
                        window.location.reload();
                    });
                }
            });            
        });
    });

    //Actializa la pagina 
    $('#block-save').click(function(){ window.location.reload() });

    // Esconder aparecer formulario de seccion para las fuentes
    $('#agregarSeccionAction').on('click', function(){
        $('.form-agregar-seccion').slideToggle();
    });

    $('.cancelar').on('click', function(){
        $('.form-agregar-seccion').slideToggle();
    });

    // Enviar Formulario de agregar seccion a una fuente
    $('#form-agrega-seccion').validate({
        submitHandler: function(form){
            var $formulario = $(form);
            var datos = $formulario.serialize();
            $.post( $formulario.attr('action'), datos, function(json){
                if (json.exito) {
                    var $alert = $('.alert');
                    $alert.addClass(json.class).html(json.text).delay(3000).fadeOut('slow', function() {
                        window.location.reload();
                    });
                }
            });
        }
    });

    // Esconder aparecer formulario de agregar tema a cliente
    $('#agregarTemaAction').on('click', function(){
        $('.form-agregar-tema').slideToggle();
    });

    $('.cancelar').on('click', function(){
        $('.form-agregar-tema').slideToggle();
    });

    // Enviar Formulario de agregar tema para un cliente
    $('#form-agrega-tema').validate({
        submitHandler: function(form){
            var $formulario = $(form);
            var datos = $formulario.serialize();
            $.post( $formulario.attr('action'), datos, function(json){
                if (json.exito) {
                    var $alert = $('.alert');
                    $alert.addClass(json.class).html(json.text).delay(3000).fadeOut('slow', function() {
                        window.location.reload();
                    });
                }
            });
        }
    });

    // Esconder aparecer formulario de Relacionar cuenta
    $('#agrega-cuenta-TemaAction').on('click', function(){
        $('.form-r_cuenta-tema').slideToggle();
    });

    $('#cancelar-tema-cuenta').on('click', function(){
        $('.form-r_cuenta-tema').slideToggle();
    });

    // Enviar Formulario de relacionar cuenta
    $('#form-agrega-tema-cuenta').validate({
        submitHandler: function(form){
            var $formulario = $(form);
            var datos = $formulario.serialize();
            $.post( $formulario.attr('action'), datos, function(json){
                if (json.exito) {
                    var $alert = $('.alert');
                    $alert.addClass(json.class).html(json.text).delay(3000).fadeOut('slow', function() {
                        window.location.reload();
                    });
                }
            });
        }
    });

    // Esconder aparecer formulario de editar cliente
    $('#datos-cliente button').on('click', function(){
        $('#datos-cliente').hide('slow');
        $('#edita-datos-cliente').slideToggle();
    });

    $('#calcela-editar-datos').on('click', function(){
        $('#datos-cliente').show('slow');
        $('#edita-datos-cliente').hide('slow');
    });

    // Enviar Formulario editar cliente
    $('#form-edita-cliente').validate({
        submitHandler: function(form){
            var $formulario = $(form);
            var datos = $formulario.serialize();
            $.post( $formulario.attr('action'), datos, function(json){
                if (json.exito) {
                    var $alert = $('.alert');
                    $alert.addClass(json.class).html(json.text).delay(2000).fadeOut('slow', function() {
                        window.location.reload();
                    });
                }
            });
        }
    });

    // Esconder aparecer formulario de cambiar Logo
    $('#cambiar-imagen-cliente').on('click', function(){
        $('#logo-cliente').hide('slow');
        $('#cambiar-logo-action').slideToggle();
    });

    $('#cancelar-guarda-logo').on('click', function(){
        $('#logo-cliente').show('slow');
        $('#cambiar-logo-action').hide('slow');
    });

    // Esconder aparecer formulario de cambiar Headers
    $('#editar-encabezado').on('click', function(){
        $('#encabezados-adjunto').hide('slow');
        $('#actions-headers').hide();
        $('#headers-edit').slideToggle();
    });

    $('#cancel-edit-headers').on('click', function(){
        $('#encabezados-adjunto').show('slow');
        $('#actions-headers').show();
        $('#headers-edit').hide('slow');
    });

    // // Enviar Formulario cambiar logo
    // $('#form-cambia-imagen').validate({
    //     submitHandler: function(form){
    //         var $formulario = $(form);
    //         var datos = $formulario.serialize();
    //         $.post( $formulario.attr('action'), datos, function(json){
    //             if (json.exito) {
    //                 var $alert = $('.alert');
    //                 $alert.addClass(json.class).html(json.text).delay(2000).fadeOut('slow', function() {
    //                     window.location.reload();
    //                 });
    //             }
    //         });
    //     }
    // });

    // Esconder aparecer formulario de agregar una cuenta
    $('#agregarCuentaAction').on('click', function(){
        
        $('.form-agregar-cuenta').slideToggle('slow');
        var posicion = $(".form-agregar-cuenta").offset().top;
        $("html, body").animate({
            scrollTop: posicion
        }, 2000); 

    });

    $('#cancela-nueva-cuenta').on('click', function(){
        $('.form-agregar-cuenta').hide('slow');
    });

    // Enviar Formulario para agregar una cuenta a un cliente
    $('#form-agrega-cuenta').validate({
        messages:{
            nombre: 'Ingresa tu(s) nombre(s)',
            apellidos: 'Ingresa tus apellidos',
            correo:{
                required: 'Debes ingresar un correo',
                email: 'El correo debe de ser de formato nombre@dominio.com'
            },
            tel_casa: 'Ingresa un numero de teléfono',
            username: 'Escribe tu nombre de usuario',
            password: 'Necesitas una contraseña'
        },
        submitHandler: function(form){
            var $formulario = $(form);
            var datos = $formulario.serialize();
            $.post( $formulario.attr('action'), datos, function(json){
                if (json.exito) {
                    var $alert = $('.alert');
                    $alert.addClass(json.tipo).html(json.mensaje).delay(3000).fadeOut('slow', function() {
                        window.location.reload();
                    });
                }
            });
        }
    });

    // Muestra el formulario para editar un usuario
    $('#btn-edit-user').on('click', function(){
        $('#user-edit').slideToggle();
    });

    // muestra y oculta los contacos de un tema 
    $('.btn-view-contacts').on('click', function()
   {
        var $btn = $(this);
        var $idTable = $btn.data('id');
        var $cajita = $('#table' + $idTable);

        if( $btn.hasClass('d-info') ){
            $btn.removeClass('d-info');
            $btn.addClass('d-danger');
        }else{
            $btn.removeClass('d-danger');
            $btn.addClass('d-info');
        }
        
        $cajita.slideToggle();


   });

    //elimina un adjunto
    $('#eliminar-encabezado').click(function( event ){
        event.preventDefault();
        var boton = $(this);
        var data = {
            id_encabezado: boton.data('idencabezado'),
            id_adjunto: boton.data('idadjunto'),
            id_noticia: boton.data('idnew')
        };
        var $alert = $('.alert');
        var $modal = $('#myModal');
        var $eliminar = $modal.find('.modal-footer .btn-primary');
        $modal.find('#myModalLabel').html('Eliminar Archivo');
        $modal.find('.modal-body').html('Esta seguro que decea eliminar este archivo?.');
        $eliminar.html('Eliminar');
        $eliminar.click(function(){
            console.log('ouch');
            $.post('/panel/new/encabezado/delete', data, function(json){
                //if (json.exito) {
                    $modal.modal('toggle');
                    $alert.removeClass(json.tipo);
                    $alert.removeAttr('style');
                    $alert.addClass(json.tipo).html(json.mensaje).delay(3000).fadeOut('slow', function(){
                        boton.parent().fadeOut('slow');
                        window.location = json.ruta;
                    });
                //}
            });            
        });
    });

    jQuery('#btn-changeImage').on('click', function (event) {
        var $boton = $(this);
        var contenedor = $boton.parent();
        contenedor.find('img').remove();
        contenedor.find('input.inp-thum').attr('disabled', false).show();
        var input = contenedor.find('input.imagen');
        input.attr('value', '');
        $boton.remove();
    });

    // Eliminar una columna
    $('.delete-column').click(function( event ){
        event.preventDefault();
        var $boton = $(this);
        var id = $boton.data('id');
        var $alert = $('.alert');
        var $modal = $('#myModal');
        var $eliminar = $modal.find('.modal-footer .btn-primary');
        $modal.find('#myModalLabel').html('Eliminar Columna');
        $modal.find('.modal-body').html('Esta seguro que decea eliminar esta columna.');
        $eliminar.html('Eliminar');
        
        $eliminar.click(function(){
            $.get('/panel/prensa/delete/column/' + id, function(json){
                if (json.exito) {
                    $modal.modal('toggle');
                    $alert.removeClass(json.tipo);
                    $alert.removeAttr('style');
                    $alert.addClass(json.tipo).html(json.mensaje).delay(3000).fadeOut('slow', function(){
                        window.location = json.url;
                    });
                }
            });            
        });
    });
    

    /********************** drag an drop  **************************/

    
    /************************************************************/

    function flashAlerts(){
        $('.alert-controller').delay(3000).fadeOut('slow');
    }

    flashAlerts();
    
    



    


}); /* DOCUMMENT READY */

