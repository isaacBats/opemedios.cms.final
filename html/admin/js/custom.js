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

    }catch(e){

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
                        window.location.reload();
                    });
                    $formulario.fadeOut('slow');
                }
            });
        }
    });
    


}); /* DOCUMMENT READY */

