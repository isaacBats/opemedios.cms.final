$(document).ready(function () {
    $('#contenido, #contenido_en').summernote({
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['fontsize', ['fontsize', 'link']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph', 'hr']]

        ]
    });

 

    $('#fecha').datepicker();

    /* Cambia el lenguaje del datepicker a espaÃ±ol */
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


    $('#addNew').validate({
        rules: {
            'titulo': {required: true},
            'slug': {required: true},
            'titulo_en': {required: true},
            'extracto': {required: true},
            'extracto_en': {required: true},
            'contenido': {required: true},
            'contenido_en': {required: true},
            // 'imagen_thumbnail': { required : true, extension: "jpg" },
            // 'imagen': { required : true, extension: "jpg" },
            'fecha': {required: true}
        },
        messages: {
            'titulo': {required: ''},
            'slug': {required: ''},
            'titulo_en': {required: ''},
            'extracto': {required: ''},
            'extracto_en': {required: ''},
            'contenido': {required: ''},
            'contenido_en': {required: ''},
            // 'imagen_thumbnail' : { required : '', extension:''},
            // 'imagen' : { required : '', extension:''},
            'fecha': {required: ''}
        },
        errorClass: "error",
        debug: true,
        submitHandler: function (form) {
            form.submit();
        }
    });

    jQuery('.thmb').hover(function () {
        var t = jQuery(this);
        t.find('.ckbox').show();
        t.find('.fm-group').show();
    }, function () {
        var t = jQuery(this);
        if (!t.closest('.thmb').hasClass('checked')) {
            t.find('.ckbox').hide();
            t.find('.fm-group').hide();
        }
    });

    jQuery('.ckbox').each(function () {
        var t = jQuery(this);
        var parent = t.parent();
        if (t.find('input').is(':checked')) {
            t.show();
            parent.find('.fm-group').show();
            parent.addClass('checked');
        }
    });

    jQuery('.product').click(function () {
        var datos = {};
        datos.id = $(this).attr("id");
        jQuery.post('/panel/catalog/mainproductbycat', datos, function (json) {
            location.reload();
        });
    });
    jQuery('#user_status').change(function () {
        var datos = {};
        datos.id_registro = $(this).val();
        jQuery.post('/panel/users/updateStatus', datos, function (json) {
            if (json.exito) {
                window.location.href = "../users/list";
            }
        });
    });
    jQuery('.ckbox').click(function () {
        var t = jQuery(this);
        if (!t.find('input').is(':checked')) {
            t.closest('.thmb').removeClass('checked');
            enable_itemopt(false);
        } else {
            t.closest('.thmb').addClass('checked');
            enable_itemopt(true);
        }
    });

    jQuery('.mainpanel').on('click', 'a.btn.eliminar', function (event) {
        event.preventDefault();
        var boton = jQuery(this);
        data = {};
        data.contenedor = boton.parent().parent();
        data.id_elemento = boton.data('id');
        data.accion = 'eliminar_elemento';
        data.titulo = 'Eliminar contacto';
        data.descripcion = 'Si borra el contacto no podrá volver a atras';
        dialogo_confirmacion(data);
    });

    function dialogo_confirmacion(data) {
        var confirmacion = jQuery("#confirmacion");
        var descripcion = confirmacion.find('p');
        confirmacion.attr('title', data.titulo);
        descripcion.html(data.descripcion);
        var contenedor_eliminar = data.contenedor;

        var datos = {};
        datos.id_borrar = data.id_elemento;


        jQuery("#confirmacion").dialog({
            resizable: false,
            width: 250,
            modal: true,
            buttons: {
                "Confirmar": function () {
                    jQuery(this).dialog("close");
                    console.log(datos);
                    jQuery.post('/panel/contact/remove', datos, function (json) {
                        console.log(json);
                        if (json.exito) {
                            contenedor_eliminar.fadeOut();
                        }
                    });
                },
                Cancelar: function () {
                    jQuery(this).dialog("close");
                    return false;
                }
            }
        });
    }

    jQuery('a.borrar.atributo.imagen').on('click', function (event) {
        var boton = jQuery(this);
        var contenedor = boton.parent();
        contenedor.find('img').remove();
        contenedor.find('input.inp-thum').attr('disabled', false).show();
        var input = contenedor.find('input.imagen');
        input.attr('value', '');
        boton.remove();
    });
});