<div class="profile">
	<form method="POST" action="/profile/my-quote/detail-session/save">
	<div class="profile_menu">
		
		<h2><?php echo $_SESSION["user"]['nombre'].' '.$_SESSION["user"]['apellidos'] ?></h2>
		<?php require "profile.menu.php"; ?>
	</div>		
	<div class=" profile_form ">
		<?php 
			foreach ($products as $product) {
				$html = '<div class="list-item">
						    <div class="img-listado">
						        <a href="'.$this->url($lang,'/product/'.$product['product']['ur']).'">
						            <img 
						                alt="'.$product['product']['nombre'].'" 
						                src="http://www.alfonsomarinaebanista.com/images/'.$product['product']['ur'].'/'.$product['product']['ur'].'_alta2.jpg">
						        </a>
						    </div>
						    <div class="texto-listado">
						    	<h2>
						            <a href="'.$this->url($lang,'/product/'.$product['product']['ur']).'">
						                <h2>'.$product['product']['nombre'].'</h2>
						            </a>
						        </h2>
						        <div class="separador">
						            <table width="100%">
						                <tbody><tr>
						                    <td><strong>'.$product['product']['ur'].'</strong></td>';
						                    if ( $_SESSION["user"]["precio"] == "precio" ){
						                    	$html .= '<td>Precio: <strong>'.$product['product']['precio'].'</strong></td>';
						                    }elseif ( $_SESSION["user"]["precio"] == "_price" ){
						                    	$html .= '<td>Precio: <strong>'.$product['product']['_price'].'</strong></td>';
											}
						      $html .= '</tr>
						                <tr>
						                    <td>
						                        Acabado: <strong>'.$product['product']['acabado'].'</strong>
						                    </td>
						                    <td>Cantidad:
						                            <input type="number" value="'.$product['quantity'].'" class="cant-quote" name="'.$product['id'].'">
						                    </td>
						                </tr>
						            </tbody></table>
						        </div>
						            <a href="javascript:void(0);" id="btn-cot" class="general-btn half btn-cotiza eliminar" data-id="'.$product['product']['id'].'">Eliminar de Cotización</a>
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
		                <strong>Total: <span>$281,450.00</span></strong><br>
		            </td>
		        </tr><tr>
		                 <td>
		                     <input class="boton" type="submit" value="Guardar">
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
	</form>
</div>