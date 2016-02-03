


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

	

});

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
//  HOME
function startHomeSlide(){
		$(".slidetabs").tabs(".images > div", {
	      effect: 'fade',
	      fadeOutSpeed: "slow",
	      rotate: true
	  }).slideshow({
	  	interval: 2000,
	  	autoplay: true,
	  	clickable: false
	  });
	
		var imgHeight = $('#imgHome > img').height();
		var imgWidth = $('#imgHome > img').width();

		$('#imgHome').css('height', imgHeight*0.92);
		$('#imgHome').css('width', imgWidth);

		$(window).resize(function(){
			var imgHeight = $('#imgHome > img').height();
			var imgWidth = $('#imgHome > img').width();
			$('#imgHome').css('height', imgHeight*0.92);
			$('#imgHome').css('width', imgWidth);
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
    