  try{
		function getSearch( value ){
		      jQuery.post("/catalog/browser/json", {q:value} , function(json){
		        var temp = "";
		        for( p in json ){
		          temp += "<li><a href='"+json[p].url+"'>"+json[p].nombre+"</a></li>";
		        }
		        jQuery("#autocomplete").html( temp );
		      },"json");
		    }
		    
    
  } catch(e ){
    console.log(e )
  } 
  
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

	try{
		$("img").load(function(){
	    	var $this = $(this);
		    if ($this.width() > $this.height()) {
		        $this.parent().addClass("horizontal");
		        console.log( $this.width() , $this.height())
		    }
		});
		
	}catch(e){
		console.log( e )
	}

	try{

	
	var gallery = $('#gallery').galleriffic('#navigation', {
		delay: 300,
		numThumbs: 13,
		preloadAhead: 0,
		imageContainerSel: '#slideshow',
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

	jQuery('#btn-fav').on('click', function(event) {
		event.preventDefault();
		var boton = jQuery(this);
		var id = boton.data('id');
		if( boton.hasClass('eliminar') ){
			jQuery.post('/product/removeFav',{'id':id},function(json){
				if( json.exito ){
					boton.removeClass('eliminar');
					boton.html(json.mensaje);
				}
				else{
					boton.addClass('eliminar');
					boton.html(json.mensaje);
				}
			},'json');
		}else{
			jQuery.post('/product/addFav',{'id':id},function(json){
				if( json.exito ){
					boton.addClass('eliminar');
					boton.html(json.mensaje);
				}
				else{
					boton.removeClass('eliminar');
					boton.html(json.mensaje);
				}
			},'json');
		}


	});

	jQuery('#btn-cot').on('click', function(event) {
		event.preventDefault();
		var boton = jQuery(this);
		var id = boton.data('id');
		if( boton.hasClass('eliminar') ){
			jQuery.post('/profile/remove-quote',{'id':id},function(json){
				if( json.exito ){
					boton.removeClass('eliminar');
					boton.html(json.mensaje);
				}
				else{
					boton.addClass('eliminar');
					boton.html(json.mensaje);
				}
			},'json');
		}else{
			jQuery.post('/profile/add-quote',{'id':id},function(json){
				if( json.exito ){
					boton.addClass('eliminar');
					boton.html(json.mensaje);
				}
				else{
					boton.removeClass('eliminar');
					boton.html(json.mensaje);
				}
			},'json');
		}


	});

	jQuery('#news-submit').on('click', function(event) {
		event.preventDefault();
		if( jQuery('#Email').val() != "" ){
			jQuery('#newsletter')
				.find('input').remove();
				jQuery('#newsletter').find('p').fadeIn();

		}
	});

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
			//'codigopostal' : { required : true },
			//'movil' : { required : true },
			//'telefono' : { required : true },
			//'organizacion[]' : { required : true },
			'motivo' : { required : true },
			'comoseentero' : { required : true }
		},
		messages: {
			'nombre' : { required : '' },
			'apellidos' : { required : '' },
			'nombreusuario' : { required : '' },
			'passworduno' : { required : true },
			'passworddos' : { required : true, equalTo: "" },
			'email' : { required : '', email : '' },
			'empresa' : { required : '' },
			'puesto' : { required : '' },
			'website' : { required : '' },
			'direccion1' : { required : '' },
			'direccion2' : { required : '' },
			'pais' : { required : '' },
			'estado' : { required : '' },
			//'codigopostal' : { required : '' },
			//'movil' : { required : '' },
			//'telefono' : { required : '' },
			//'organizacion[]' : { required : '' },
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
	// $('#fancybox-content').after('<div class="share-product gallery" style="text-align:center; margin-top:10px; position:absolute; left:0; right: 0;"><a href="javascript:void(0);" style="font-size:18px;"><img src="/assets/images/share-it.png"></a><a href="javascript:void(0);" style="font-size:18px;"><img src="/assets/images/tweet-it.png"></a><a href="javascript:void(0);" style="font-size:18px;"><img src="/assets/images/pin-it.png"></a></div>');
}catch(e){
	console.log(e);
}
});	