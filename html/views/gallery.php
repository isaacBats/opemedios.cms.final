
<div id="navigation" class="navigation">
	<ul class="thumbs noscript">
		<?php 
			$this->displayTumbs();
		?>
	</ul>
</div>
<div id="controls" class="controls">
	
</div>
<div id="gallery" class="content">
<!--  TODO: @Gallery Arreglar error de altura on next slide (1) -->
    <div style="left: 18%;position: absolute;top:50%;margin-top:-15px;width: 30px;"><a href="#" id="navLeft"><img src="/assets/images/Prev1.png" alt=">>"/></a></div>
    <div id="slideshow" class="slideshow"></div>
    <div style="float: right;position: absolute;right: 18%;top:50%;margin-top:-15px;width: 30px;"><a href="#" id="navRight"><img src="/assets/images/Next1.png" alt="<<"/></a></div>
</div>
<div class="gallery-related">
    <div class="share-product gallery">
		<a href="javascript:void(0);"><i class="fa fa-facebook fa-lg"></i> Share it</a>
		<a href="javascript:void(0);"><i class="fa fa-twitter fa-lg"></i> Tweet it</a>
		<a href="javascript:void(0);"><i class="fa fa-pinterest-p fa-lg"></i> Pin it</a>
	</div>
		<!--    
			El metodo ya fue creado, falta implementar 
			metod name: Gallery::showRelatedAction	
		-->
	<div class="gallery-products">
		<a href="javascript:void(0);" class="rel"><img src="/assets/images/relacionado1.jpg">
			<h2>Cama Hudson King</h2>
		</a>
		<a href="javascript:void(0);" class="rel"><img src="/assets/images/relacionado3.jpg">
			<h2>Silla Viena II con brazos</h2>
		</a>
		<a href="javascript:void(0);" class="rel"><img src="/assets/images/relacionado2.jpg">
			<h2>Banqueta Varent</h2>
		</a>
	</div>
	<div class="aux-tools">
		<!-- <a href="javascript:void(0);"><i class="fa fa-envelope-o fa-lg"></i> <?php echo $this->trans($lang,"Enviar por correo","Send it by e-mail"); ?></a>
		<a href="javascript:void(0);"><i class="fa fa-print fa-lg"></i> <?php echo $this->trans($lang,"Imprimir","Print"); ?></a> -->
	</div>
</div>
