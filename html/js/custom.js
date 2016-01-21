var _progressBar = "";

function controllProgressBtn(){
	
	if( _progressBar.length > 5  ){
		_progressBar = ".";
	}else{
		_progressBar += ".";
	}
	jQuery("#btn-registro").val(_progressBar);

}

jQuery(document).ready(function($){


	jQuery('#frmRegistro').validate({
		rules: {
			'nombre' : { required : true },
			'apellidos' : { required : true },
			'nombreusuario' : { required : true },
			'passworduno' : { required : true },
			'passworddos' : { required : true, equalTo: "#passworduno"},
			'email' : { required : true, email : true },
			'empresa' : { required : true },
			'puesto' : { required : true },
			'website' : { required : true },
			'direccion1' : { required : true },
			'direccion2' : { required : true },
			'pais' : { required : true },
			'estado' : { required : true },
			'codigopostal' : { required : true },
			'movil' : { required : true },
			'telefono' : { required : true },
			'organizacion[]' : { required : true },
			'motivo' : { required : true },
			'comoseentero' : { required : true }
		},
		messages: {
			'nombre' : { required : '' },
			'apellidos' : { required : '' },
			'nombreusuario' : { required : '' },
			'passworduno' : { required : true },
			'passworddos' : { required : true, equalTo: "Debe coincidir la contraseña" },
			'email' : { required : '', email : '' },
			'empresa' : { required : '' },
			'puesto' : { required : '' },
			'website' : { required : '' },
			'direccion1' : { required : '' },
			'direccion2' : { required : '' },
			'pais' : { required : '' },
			'estado' : { required : '' },
			'codigopostal' : { required : '' },
			'movil' : { required : '' },
			'telefono' : { required : '' },
			'organizacion[]' : { required : '' },
			'motivo' : { required : '' },
			'comoseentero' : { required : '' }
		},
		errorClass : "error",
		debug: true,
		submitHandler: function(form){ 
			var formulario = jQuery(form);
			var datos = formulario.serialize();
			jQuery('#btn-registro').attr("disabled","disabled");
			window.progreso = setInterval(controllProgressBtn , 500);

			jQuery.post(formulario.attr('action'),datos,function(json){
				if (json.exito) {
					formulario.fadeOut('slow', function() {
						jQuery('#mensaje').html(json.mensaje);	
						clearInterval( window.progreso );
					});
				}
				else{

				}
			}); 
		}
	});




jQuery('#contact-form').validate({
	rules: {
		'nombre':{required:true},
		'empresa':{required:true},
		'puesto':{required:true},
		'pais':{required:true},
		'estado':{required:true},
		'codigopostal':{required:true},
		'telefono':{required:true},
		'email':{required:true,email:true},
		'comoseentero':{required:true}
	},
	messages: {
		'nombre':{required:''},
		'empresa':{required:''},
		'puesto':{required:''},
		'pais':{required:''},
		'estado':{required:''},
		'codigopostal':{required:''},
		'telefono':{required:''},
		'email':{required:'',email:''},
		'comoseentero':{required:''}
	},
	errorClass : "error",
	debug: true,
	submitHandler: function(form){ 
		var formulario = jQuery(form);
		var datos = formulario.serialize();
		jQuery('#btn-submit').attr("disabled","disabled").val('Enviando...');
		jQuery.post(formulario.attr('action'),datos,function(json){
			if (json.exito) {
				formulario.fadeOut('slow', function() {
					jQuery('#mensaje').html(json.mensaje);	
				});
			}
			else{

			}
		}); 
	}
});

try{
	var gallery = $('#gallery').galleriffic('#navigation', {
		delay: 300,
		numThumbs: 13,
		preloadAhead: 0,
		imageContainerSel: '#slideshow',
		controlsContainerSel: '#controls',
		fixedNavigation: true,
		galleryKeyboardNav: true,
		autoPlay: false,
		enableHistory: false,
		enableTopPager: false,
		enableBottomPager: true,
		renderSSControls: false,
		nextLinkText: '>',
		prevLinkText: '<'
	});
	gallery.onFadeOut = function () {
		$('#details').fadeOut('fast');
	};
	gallery.onFadeIn = function () {
		$('#details').fadeIn('fast');
	};

}catch(e){
	console.log(e);
}
try{
	var imgHeight = $('#imgHome > img').height();
	var imgWidth = $('#imgHome > img').width();

	$('#imgHome').css('height', imgHeight);
	$('#imgHome').css('width', imgWidth);
	$(window).resize(function(){
		var imgHeight = $('#imgHome > img').height();
		var imgWidth = $('#imgHome > img').width();

		$('#imgHome').css('height', imgHeight);
		$('#imgHome').css('width', imgWidth);
	});
	$(".slidetabs").tabs(".images > div", {
      // enable "cross-fading" effect
      effect: 'fade',
      fadeOutSpeed: "slow",
      // start from the beginning after the last tab
      rotate: true

      // use the slideshow plugin. It accepts its own configuration
  }).slideshow({
  	autoplay: true,
  	clickable: false
  });
}catch(e){
	console.log('Slideshow home error: '+e);
}


var anchoNav;
var anchoTotal = 0;

$("#main-nav li:has(ul)").addClass("submenu");

try {
	$(".fancybox").fancybox({
		openEffect: 'elastic',
		closeEffect: 'elastic'
	});
} catch(e) {
	console.log(e);
}

$('#main-aside > ul > li > a').on('click', function(){
	$(this).next('ul').slideToggle();
});
try{
	// $("#gallery").on("focusin", function(){
	// 	$("a.fancybox").fancybox({
	// 		openEffect: 'elastic',
	// 		closeEffect: 'elastic',
	// 		titleShow: false,
	// 		showNavArrows: true
	// 	});
	// });
	// $('#fancybox-content').after('<div class="share-product gallery" style="text-align:center; margin-top:10px; position:absolute; left:0; right: 0;"><a href="javascript:void(0);" style="font-size:18px;"><img src="/images/share-it.png"></a><a href="javascript:void(0);" style="font-size:18px;"><img src="/images/tweet-it.png"></a><a href="javascript:void(0);" style="font-size:18px;"><img src="/images/pin-it.png"></a></div>');
}catch(e){
	console.log(e);
}
});	