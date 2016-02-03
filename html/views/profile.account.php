<div class="profile">
	<div class="profile_menu">
		
		<h2><?php echo $_SESSION["user"]['nombre'].' '.$_SESSION["user"]['apellidos'] ?></h2>
		<?php require "profile.menu.php"; ?>
	</div>		
	<div class=" profile_form ">
		<p>
			<?php echo $this->trans($lang , "*Estado de cuenta" , "*Statement"); ?>
		</p>
		
	</div>
	<br class="clear">
</div>