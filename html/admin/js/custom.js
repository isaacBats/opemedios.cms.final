$(document).ready(function(){
    $("#selectFuente").select2({
      placeholder: "Seleccione una Fuente",
      allowClear: true
    });
});
 

    
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

    $('.fechaNota').datepicker({
    dateFormat: 'yy-mm-dd',
    startDate: '-3d'
    });

   
$(function() {
    $('.date_time').datetimepicker({
      pickDate: false
    });
  });

