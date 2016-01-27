$(document).ready(function() {
	$('#contenido, #contenido_en').summernote();
	$('#fecha').datepicker();

	/* Cambia el lenguaje del datepicker a espaÃ±ol */
	$.datepicker.regional['es'] = {
	    closeText: 'Cerrar',
	    prevText: '',
	    nextText: '',
	    currentText: 'Hoy',
	    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	    monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
	    dayNames: ['Domingo', 'Lunes', 'Martes', 'MiÃ©rcoles', 'Jueves', 'Viernes', 'SÃ¡bado'],
	    dayNamesShort: ['Dom','Lun','Mar','MiÃ©','Juv','Vie','SÃ¡b'],
	    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
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
		'titulo': { required : true },
		'slug': { required : true  },
		'titulo_en': { required : true },
		'extracto': { required : true },
		'extracto_en': { required : true },
		'contenido': { required : true },
		'contenido_en': { required : true },
		'imagen_thumbnail': { required : true, extension: "jpg" },
		'imagen': { required : true, extension: "jpg" },
		'fecha': { required : true }
    },
    messages: {
		'titulo' : { required : '' },
		'slug' : { required : '' },
		'titulo_en' : { required : '' },
		'extracto' : { required : '' },
		'extracto_en' : { required : '' },
		'contenido' : { required : '' },
		'contenido_en' : { required : '' },
		'imagen_thumbnail' : { required : '', extension:''},
		'imagen' : { required : '', extension:''},
		'fecha' : { required : '' }
    },
    errorClass : "error",
    debug: true,
    submitHandler: function(form){ 
    	form.submit();
    }
  });
	
});