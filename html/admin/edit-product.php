<div class="panel">
  <div class="panel-heading">
    <h4 class="panel-title">Editar Producto</h4>
  </div>
  <div class="panel-body">
    <form method="post" action="/panel/catalog/product/update" id="addNew" enctype="multipart/form-data">
      <div class="form-group">
        <input type="hidden" value="<?php echo $row['id'] ?>" class="form-control" name="id">
      </div>
      <div class="form-group">
	      <label for="ur" >UR</label>
	      <input type="text" value = "<?php echo $row['ur'] ?>" class="form-control" name="ur">
      </div>
      <div class="form-group">
      	<label for="nombre" >Nombre</label>
      	<input type="text" value = "<?php echo $row['nombre'] ?>" class="form-control" name="nombre">
      </div>
      <div class="form-group">
      	<label for="caracter" >Caracter</label>
        <input type="text" value = "<?php echo $row['caracter'] ?>" class="form-control" name="caracter">
      </div>
      <div class="form-group">
      	<label for="acabado" >Acabado</label>
	    <input type="text" value = "<?php echo $row['acabado'] ?>" class="form-control" name="acabado">
      </div>
      <div class="form-group">
      	<label for="tipoDeAcabado" >Tipo de acabado</label>
        <input type="text" value = "<?php echo $row['tipo_acabado'] ?>" class="form-control" name="tipoAcabado">
      </div>
      <div class="form-group">
      	<label for="comoSeMuestra" >Como se muestra</label>
        <input type="text" value = "<?php echo $row['como_se_muestra'] ?>" class="form-control" name="comoSeMuestra">
      </div>
      <div class="form-group">
     	<label for="precio" >Precio</label>
        <input type="text" value = "<?php echo $row['precio'] ?>" class="form-control" name="precio">
      </div>
      <div class="form-group">
      	<label for="precio Pintado" >Precio Pintado</label>
        <input type="text" value = "<?php echo $row['precio_pintado'] ?>" class="form-control" name="precioPintado">
      </div>
      <div class="form-group">
      	<label for="familia" >Familia</label>
	    <input type="text" value = "<?php echo $row['familia'] ?>" class="form-control" name="familia">
      </div>
      <div class="form-group">
      	<label for="original" >Original</label>
        <input type="text" value = "<?php echo $row['original'] ?>" class="form-control" name="original">
        <span class="help-block">Variante de producto. Si no tiene poner un " - "</span>
      </div>
      <div class="form-group">
      	<label for="tipo" >Tipo</label>
        <input type="text" value = "<?php echo $row['tipo'] ?>" class="form-control" name="tipo">
      </div>
      <div class="form-group">
      	<label for="categoria" >Categoria</label>
        <input type="text" value = "<?php echo $row['categoria'] ?>" class="form-control" name="categoria">
      </div>
      <div class="form-group">
      	<label for="uso" >Uso</label>
        <input type="text" value = "<?php echo $row['uso'] ?>" class="form-control" name="uso">
      </div>
      <div class="form-group">
      	<label for="frente" >Frente</label>
        <input type="text" value = "<?php echo $row['frente'] ?>" class="form-control" name="frente">
      </div>
      <div class="form-group">
      	<label for="fondo" >Fondo</label>
        <input type="text" value = "<?php echo $row['fondo'] ?>" class="form-control" name="fondo">
      </div>
      <div class="form-group">
      	<label for="altura" >Altura</label>
        <input type="text" value = "<?php echo $row['altura'] ?>" class="form-control" name="altura">
      </div>
      <div class="form-group">
      	<label for="diametro" >Diametro</label>
        <input type="text" value = "<?php echo $row['diametro'] ?>" class="form-control" name="diametro">
      </div>
      <div class="form-group">
      	<label for="frentePulgadas" >Frente en Pulgadas</label>
        <input type="text" value = "<?php echo $row['frentre_plg'] ?>" class="form-control" name="frentePLG">
      </div>
      <div class="form-group">
      	<label for="fondoPulgadas" >Fondo en Pulgadas</label>
        <input type="text" value = "<?php echo $row['fondo_plg'] ?>" class="form-control" name="fondoPLG">
      </div>
      <div class="form-group">
      	<label for="alturaPulgadas" >Altura en Pulgadas</label>
        <input type="text" value = "<?php echo $row['altura_plg'] ?>" class="form-control" name="alturaPLG">
      </div>
      <div class="form-group">
     	<label for="diametroPulgadas" >Diametro en Pulgadas</label>
        <input type="text" value = "<?php echo $row['diametro_plg'] ?>" class="form-control" name="diametroPLG">
      </div>
      


      <div class="form-group">
      	<label for="name" >Name</label>
        <input type="text" value = "<?php echo $row['_name'] ?>" class="form-control" name="name">
      </div>
      <div class="form-group">
      	<label for="character" >Character</label>
        <input type="text" value = "<?php echo $row['_character'] ?>" class="form-control" name="character">
      </div>
      <div class="form-group">
      	<label for="currentFinish" >Current Finish</label>
        <input type="text" value = "<?php echo $row['current_finish'] ?>" class="form-control" name="currentFinish">
      </div>
      <div class="form-group">
      	<label for="created" >Created</label>
        <input type="text" value = "<?php echo $row['created'] ?>" class="form-control" name="created">
        <span class="help-block">Ejemplo: 2015-10-01</span>
      </div>
      <div class="form-group">
      	<label for="productoRelacionado" >Producto Relacionado</label>
        <input type="text" value = "<?php echo $row['_match'] ?>" class="form-control" name="match">
        <span class="help-block">UR de producto relacionado. Si no tiene poner un " - "</span>
      </div>
      <div class="form-group">
      	<label for="price" >Price</label>
        <input type="text" value = "<?php echo $row['_price'] ?>" class="form-control" name="price">
      </div>
      <div class="form-group">
      	<label for="pricePainted" >Price Painted</label>
        <input type="text" value = "<?php echo $row['price_painted'] ?>" class="form-control" name="pricePainted">
      </div>
      <div class="form-group">
      	<label for="type" >Type</label>
        <input type="text" value = "<?php echo $row['_type'] ?>" class="form-control" name="type">
      </div>
      <div class="form-group">
      	<label for="category" >Category</label>
        <input type="text" value = "<?php echo $row['_category'] ?>" class="form-control" name="category">
      </div>
      <div class="form-group">
      	<label for="use" >Use</label>
        <input type="text" value = "<?php echo $row['_use'] ?>" class="form-control" name="use">
      </div>
      <div class="form-group">
		<?php if($row['imagen'] != "default2.jpg"){ ?>
        	<img src="/assets/images/products/<?php echo $row['ur']."/".$row['imagen']?>" height="150" width="150">
        	<input type="hidden" value="<?php echo $row['imagen'] ?>" class="form-control" name="imagen">
        <?php }else{ ?>
        	<img src="/assets/images/products/<?php echo $row['imagen']?>" height="150" width="150">
        	<input type="hidden" value="<?php echo $row['imagen'] ?>" class="form-control" name="imagen">
        <?php } ?>
        
        <input type="file" name="imagen" id="input-imagen" class="inp-thum">
        <a href="javascript:void(0);" id="btn-changeImage" class="borrar atributo imagen btn btn-default" ><i class="fa fa-pencil-square-o"> Cambiar</i></a>
        <span class="help-block">Imagen del producto</span>
      </div>
      <br>
      <div class="form-group">
        <button type="submit" id="btn-submit" class="btn btn-success">Actualizar</button>
      </div>
    </form>
  </div>
</div>
