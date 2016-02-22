<div class="profile">
	<div class="profile_menu">
		
		<h2><?php echo $_SESSION["user"]['nombre'].' '.$_SESSION["user"]['apellidos'] ?></h2>
		<?php require "profile.menu.php"; ?>
	</div>		
	<div class=" profile_form ">
		<?php 
			foreach ($products as $product) {
				$html = '<div class="list-item">
						    <div class="img-listado">
						        <a href="'.$this->url($lang,'/product/'.$product['ur']).'">
						            <img 
						                alt="'.$product["nombre"].'" 
						                src="http://www.alfonsomarinaebanista.com/images/'.$product["ur"].'/'.$product["ur"].'_alta2.jpg">
						        </a>
						    </div>
						    <div class="texto-listado">
						        <h2>
						            <a href="'.$this->url($lang,'/product/'.$product['ur']).'">
						                <h2>'.$product['nombre'].'</h2>
						            </a>
						        </h2>
						        <div class="separador">
						            <table width="100%">
						                <tbody><tr>
						                    <td><strong>'.$product['ur'].'</strong></td>
						                    <td>Precio: <strong data-price >'.$product['Precio cotizado'].'</strong></td>
						                </tr>
						                <tr>
						                    <td>
						                        Acabado: <strong>'.$product['acabado'].'</strong>
						                    </td>
						                    <td>Cantidad:
						                            <input text="'.$product['quantity'].'" value="'.$product['quantity'].'" class="cant-quote" data-quantity>
						                    </td>
						                </tr>
						            </tbody></table>
						        </div>
						            <a class="boton removeFromCotz" href="#">Eliminar de Cotización</a>
						    </div>
						    <br class="clear">
						</div>';
				echo $html;
			}
		?>
		<div class="texto-listado">
		    <table style="width: 100%;">
		        <tbody><tr>
		            <td>
		                &nbsp;
		            </td>
		            <td>
		                <strong>Total: <span id="priceTotal" >$ </span></strong><br>
		            </td>
		        </tr><tr>
		                 <td>
		                     <a href="#" class="boton">Guardar</a>
		                     &nbsp;
		                 </td>
		                 <td>
		                     <div id="confirm-wrapper">
		                     <a href="#" class="boton">Confirmar Orden</a>
		                     </div>
		                 </td>
		             </tr>
		    </tbody></table>
		</div>		
	</div>
	<br class="clear">
</div>