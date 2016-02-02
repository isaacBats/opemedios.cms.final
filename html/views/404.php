<?php 

	$nobeard = true;
	require  "header.php";	
 ?>		
			
		
<div id="page-404">
		<h1>404</h1>
		<p><?php echo $this->trans($lang , "Página no encontrada" ,"Page not found") ?></p>
	</div><!-- #page-404 -->
<?php 
require  "footer.php";

?>