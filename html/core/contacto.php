<?php


/**
*  Controlador de contacto
*/

class Contacto extends Controller
{
	
	function showForm($lang="es"){
		$html = '<div class="contact-info">
					<img src="'.$this->url($lang,'/../').'images/contacto.jpg">
					<div class="info">
						<img src="'.$this->url($lang,'/../').'images/mapa.jpg">
					</div><!-- .info -->
					<div class="info">
						<h2>Showroom México</h2>
						<p>Bosques de Duraznos 187 local 33,<br>
						Col. Bosques de las Lomas,<br>
						Del. Miguel Hidalgo<br>
						México, D.F., 11700<br>
						(+52) 55 5596-8364</p>
						<a href="mailto:centroam@alfonsomarinaebanista.com?subject=Contácto">centroam@alfonsomarinaebanista.com</a>
						<a href="javascript:void(0);" class="falta"><i class="fa fa-plus-square-o fa-lg"></i> Ver mapa</a>
						<select class="falta">
							<option>Showroom México</option>
						</select>
					</div><!-- .info -->
					<br class="clear">
				</div><!-- .coontact-info -->
				<div class="contact-form">
					<h2 class="product-title">'.$this->trans($lang,'Contactanos', 'Contact us').'</h2>
					<div class="field name">
						<input type="text" placeholder="'.$this->trans($lang,'Nombre','Name').'" class="required">				
					</div><!-- .field-->
					<div class="field">
						<input type="text" placeholder="'.$this->trans($lang,'Compañía','Company').'" class="required">
					</div><!-- .field -->
					<div class="field">
						<input type="text" placeholder="'.$this->trans($lang,'Puesto','Job title').'">
					</div><!-- .field -->
					<div class="field">
						<select>
							<option>'.$this->trans($lang,'País','Country').'</option>
						</select>
					</div><!-- .field -->
					<div class="field">
						<input type="text" placeholder="'.$this->trans($lang,'Estado / Municipio','State').'" class="required">
					</div><!-- .field -->
					<div class="field">
						<input type="text" placeholder="'.$this->trans($lang,'Código Postal','Zip Code').'" class="required">
					</div><!-- .field -->
					<div class="field">
						<input type="number" placeholder="'.$this->trans($lang,'Teléfono','Phone').'" class="required">
					</div><!-- .field -->
					<div class="field">
						<input type="email" placeholder="'.$this->trans($lang,'Correo electrónico','E-Mail').'" class="required">
					</div><!-- .field -->
					<div class="field how">
						<select class="required">
							<option>'.$this->trans($lang,'¿Cómo se enteró de nosotros?','How did you find us?').'</option>
						</select>
						<br class="clear">
					</div><!-- .field -->
					<br class="clear">
					<div class="required-fields">
						* Campos Obligatorios
					</div><!-- .required-fields -->
					<textarea  placeholder="Comentario"></textarea>
					<input type="submit" class="general-btn" value="Enviar">
				</div><!-- .contact-form -->';

		$this->addbread( array("url"=>"/contact" , "label"=>"Contacto ") );
		$this->header($lang);
		
		echo $html;
	}

}

