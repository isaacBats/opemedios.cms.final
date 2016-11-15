$(document).ready(function(){
    
    /* Cambia el lenguaje del datepicker a español */
        $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '',
            nextText: '',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'MiÃ©rcoles', 'Jueves', 'Viernes', 'SÃ¡bado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'MiÃ©', 'Juv', 'Vie', 'SÃ¡b'],
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
        $("#selectFuente").select2({
          allowClear: true
        });

        $(".select2").select2({
          allowClear: true
        });    

        $(function() {
            $('.date_time').datetimepicker({
              pickDate: false
            });
        });

        // Summernote
        $('#summernote').summernote({
            height: 200
        });

        $(function () {
            $('.relojd').datetimepicker({
                format: 'LTS'
            });
        });
    }catch(e){
        console.log(e);
    }

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

    //Actializa la pagina 
    $('#block-save').click(function(){ window.location.reload() });

    /********************** drag an drop  **************************/

    
    /************************************************************/

    function flashAlerts(){
        $('.alert-controller').delay(3000).fadeOut('slow');
    }

    flashAlerts();
    
    



    


}); /* DOCUMMENT READY */

