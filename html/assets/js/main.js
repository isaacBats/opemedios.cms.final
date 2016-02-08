


//  HOME
jQuery(document).ready(function($){


	//  HOME 
	startHomeSlide();

	//  CATALOGO
	startCatalog( );

	//  NEWSLETTER
	startNewsletter();

	// FAVORITES
	startFav();

	// START
	startGallery()
	
	// CONTACTO
	startContactForm();

});


//  START GALLERY

function startGallery(){

	if( $('#gallery').length > 0 ){
		try{
		window.gallery = $('#gallery').galleriffic('#navigation', {
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
	    window.gallery.onFadeOut = function () {
	      $('#details').fadeOut('fast');
	    };
	    window.gallery.onFadeIn = function () {
	      $('#details').fadeIn('fast');
	    };

		}catch(e){
			console.log(e);
		}
	}
}

		


//  GLOBAL 
function startNewsletter(){
	try{
		jQuery('#news-submit').on('click', function(event) {
			event.preventDefault();
			if( jQuery('#Email').val() != "" ){
				jQuery('#newsletter')
					.find('input').remove();
					jQuery('#newsletter').find('p').fadeIn();

			}
		});	
	}catch(e){
		
	}
	
}

function ImageRezise(){
	var imgHeight = $('#imgHome > img').height();
	var imgWidth = $('#imgHome > img').width();

	$('#imgHome').css('height', imgHeight*0.92);
	$('#imgHome').css('width', imgWidth);
}
//  HOME
function startHomeSlide(){
	
		setTimeout( ImageRezise , 100 );
		$(window).resize(ImageRezise);

		$(".slidetabs").tabs(".images > div", {
		      effect: 'fade',
		      fadeOutSpeed: "slow",
		      rotate: true
		  }).slideshow({
		  	interval: 2000,
		  	autoplay: true,
		  	clickable: false
		  });

		
	
}


//  CATALOG

function startCatalog(){
	
	try{
		$(".imageHolder img").each(function(){
			var $this = $(this);
		    if ($this.width() > $this.height()) {
		        $this.parent().addClass("horizontal");
		        $this.css("opacity" , "1");
		    }else{
		    	$this.css("opacity" , "1");
		    }
		});
	}catch(e){
		
	}
	
} 

// DETALLE DE PRODUCTO
function startFav(){
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
}

//  CONTACTO 
var _progressBar = "";

function controllProgressBtn(){
	if( _progressBar.length > 5  ){
		_progressBar = ".";
	}else{
		_progressBar += ".";
	}
	jQuery("#btn-registro").val(_progressBar);
}


function startContactForm(){
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
					jQuery('#alertMessage').html(json.mensaje);	
					jQuery('#alertHolder').fadeIn().click(function(){jQuery(this).fadeOut(function(){window.location.reload();});  });
				}
			}); 
		}
	});
}



//  SEARCH 
var searchStatus = null;
function activateSearch(){
	window.clearTimeout( window.searchStatus );
	jQuery("#autocomplete").show();
}
function deactivateSearch( tmr ){
	if( tmr != undefined ){
		window.searchStatus = setTimeout( function(){ 
			jQuery("#autocomplete").hide();
		},1000);
	}else{
		jQuery("#autocomplete").hide();
	}
	
}
function getSearch( value ){
  jQuery.post("/search/json", {q:value} , function(json){
    var temp = "";
    for( p in json ){
      temp += "<li><a href='"+json[p].url+"'>"+json[p].nombre+"</a></li>";
    }
    jQuery("#autocomplete").find("ul").html( temp );
  },"json");
}
    