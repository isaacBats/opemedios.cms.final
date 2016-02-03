<div class="profile">
	<div class="profile_menu">
		
		<h2><?php echo $_SESSION["user"]['nombre'].' '.$_SESSION["user"]['apellidos'] ?></h2>
		<?php require "profile.menu.php"; ?>
	</div>		
	<div class=" profile_form ">
		<p>
			<?php echo $this->trans($lang , "*Precios en moneda nacional. Iva incluido" , "*Currency MX Pesos. Taxes not included"); ?>
			
		</p>
		<a href="http://www.alfonsomarinaebanista.com//media/61779/ES_LISTA_DE_PRECIOS_MEXICO_OCTUBRE_2015.pdf" target="_blank">
			<img src="http://www.alfonsomarinaebanista.com/imgs/pdf-icon.png" style="min-width:0;width:80px;vertical-align:middle;">
			<span style="text-align:center;">Muebles</span>
		</a>
	</div>
	<br class="clear">
</div>