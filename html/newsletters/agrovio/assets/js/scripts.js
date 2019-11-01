jQuery(document).ready(function($) {
	//AGREGAR NEWSLETTER
	$(document).on('click','#validar',function(e){
		var $form = $('#loginForm'),
			$fields = $form.serialize();
		$.ajax({
			    url  : "index.php/opmedios/validar",
			    type : "post",
			    data : $fields,
	        }).done(function(response) {
	        	if (response == "error") {
	        	$('#error').slideDown(400);
	        	}
	        	else {
	        		location.reload();
	        	}
	   		});
		e.preventDefault();
	});
	$(document).on('click','#error',function(e){
		$('#error').slideUp(400);
	});
	//AGREGAR NEWSLETTER
	$(document).on('click','#add_newsletter',function(e){
		var $form = $('#form_add_newsletter'),
			$fields = $form.serialize();
 		$.ajax({
 			type : "post",
 			url  : "opmedios/add_newsletter",
 			data : $fields,
 		}).done(function() {
 			$('#alert1').slideDown(400);
 			window.setTimeout('location.reload()', 3000);
 		});
 		e.preventDefault();
 	});
	//BORRAR NEWSLETTER
	$(document).on('click','#delete_newsletter',function(e){
 		var $id = $(this).data("id");
 		$.ajax({
			type : "post",
			url  : "opmedios/delete_newsletter",
			data : {id:$id}
	        }).done(function() {
	        	$('#alert4').slideDown(400);
	        	window.setTimeout('location.reload()', 3000);
	   		});
		e.preventDefault();
 	});
 	//EDITAR NEWSLETTER
	$(document).on('click','#edit_newsletter',function(e){
		var $form = $('#form_edit_newsletter'),
			$fields = $form.serialize();
 		$.ajax({
 			type : "post",
            url: "../opmedios/form_edit_newsletter",
			data : $fields,
	        }).done(function() {
	        	$('#alert').slideDown(400);
	        	window.setTimeout('location.reload()', 3000);
	   		});
		e.preventDefault();
 	});
	//AGREGAR NOTICIA
 	$(document).on('click','#add_news',function(e){

		var $form = $('#form_add_news'),
			$fields = $form.serialize();

 		$.ajax({
			type : "post",
			url  : "../opmedios/add_item",
			data : $fields,
	        }).done(function() {
	        	$('#alert1').slideDown(400);
	        	window.setTimeout('location.reload()', 3000);
	   		});
		e.preventDefault();
 	});
 	//EDITAR NOTICIA
	$(document).on('click','#edit_news',function(e){
		var $form = $('#form_edit_news'),
			$fields = $form.serialize();
 		$.ajax({
			type : "post",
			url  : "../opmedios/form_edit_news",
			data : $fields,
	        }).done(function() {
	        	$('#alert').slideDown(400);
	        	window.setTimeout('location.reload()', 3000);
	   		});
		e.preventDefault();
 	});
 	//BORRAR NOTICIA
 	$(document).on('click','#delete_news',function(e){
 		var $id = $(this).data("id");
 		$.ajax({
 			type : "post",
            url:"../opmedios/delete_item",
			data: {id:$id}
	        }).done(function() {
	        	$('#alert3').slideDown(400);
	        	window.setTimeout('location.reload()', 3000);
	   		});
		e.preventDefault();
 	});
	//ENVIAR CORREO
 	$(document).on('click','#send_mail',function(e){

 		var $id = $(this).data("id");

 		$.ajax({
			type : "post",
			url  : "opmedios/send",
			data : {id:$id}
	        }).done(function() {
	        	$('#alert2').slideDown(400);
	        	window.setTimeout('location.reload()', 3000);
	   		});
		e.preventDefault();
 	});
 	//OBTENER NOTICIAS
	$(document).on('click','#getNews',function(e){
 		var $url =  $('#linkNews').val(),
 			$base_url = $(this).data("url");
        $.ajax({
       	    url  : $base_url + 'index.php/opmedios/temporalFile',
       	    type : 'post',
       	    data : {url:$url},
       		success: function(response){
	        	var $data = $(response).find("div.label3").text();
	        	var $data2 = $(response).find("td.label1").find('div').text();
	        	var $data3 = $(response).find("span:contains('Autor')").next().text();
	        	var $data4 = $(response).find("span:contains('Fuente')").next().text();
	       		$('#encabezado').val($data);
	       		$('#link').val($url);
	       		$('#texto').val($data2);
	       		$('.richText-editor').html($data2);
	       		$('#fuente').val($data4 + ", " + $data3);
       		}
        });
         e.preventDefault();           
  	});
  	//EDITOR DE TEXTO NOTICIAS
  	$('#texto').richText({
		bold         : true,
		italic       : true,
		underline    : true,
		leftAlign    : false,
		centerAlign  : false,
		rightAlign   : false,
		ol           : false,
		ul           : false,
		heading      : false,
		fonts        : false,
		fontColor    : false,
		imageUpload  : false,
		fileUpload   : false,
		videoEmbed   : false,
		urls         : false,
		table        : false,
		removeStyles : false,
		code         : false,
	});
  	$(document).on('paste','.richText-editor',function(){
  		setTimeout(function() {
            $('.richText-editor').find('p,span,u,i,b,a,strong,small,em,h1,h2,h3,h4,h5,h6,div,article,mark,nav,header,footer,time,figcaption,details,ul,li,table,tr,td,tbody').contents().unwrap();
        	$('.richText-editor').find('br,hr').remove();
        	$('.richText-editor').html(
			    $('.richText-editor').html().replace('<!--', '')
			);

        }, 100);
  	});
  	//EDITAR EMPRESA
	$(document).on('click','#edit_company',function(e){
		var $form = $('#form_edit_company'),
			$fields = $form.serialize();
	   	$.ajax({
			type : "post",
			url  : "../opmedios/verify_mails",
			data : $fields,
	        }).done(function(response) {
	        	if (response == "error") {
	        		$('#error_mails').slideDown(400);
	        	}
	        	else {
	        		$.ajax({
			 			type : "post",
			            url: "../opmedios/form_edit_company",
						data : $fields,
				        }).done(function() {
				        	$('#error_mails').slideUp(400);
	        				$('#alert').slideDown(400);
				        	window.setTimeout('location.reload()', 3000);
				   	});
	        	}
	   		});
		e.preventDefault();
 	});
//ENVIAR CORREO PERSONALIZADO
	$(document).on('click','#btn_custom_send', function () {
       var $id = $(this).data("id");
       $('#idNewsletter').val( $id );
	});
 	$(document).on('click','#send_custom_mail',function(e){
 		var $form = $('#form_custom_send'),
			$fields = $form.serialize();
 		$.ajax({
			type : "post",
			url  : "opmedios/verify_mails",
			data : $fields,
	        }).done(function(response) {
	        	if (response == "error") {
	        		$('#error_mails').slideDown(400);
	        	}
	        	else {
	        		$.ajax({
						type : "post",
						url  : "opmedios/custom_send",
						data : $fields,
				        }).done(function() {
				        	$('#error_mails').slideUp(400);
	        				$('#confirm_send').slideDown(400);
				   	});
	        	}
	   		});
		e.preventDefault();
 	});
 	
});

 	