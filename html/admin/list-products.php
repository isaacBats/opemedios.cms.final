<div class="table-responsive">
	  <h3>Productos</h3>
	  <table class="table table-bordered table-default table-striped nomargin">
	    <thead class="success">
	      <tr>
	        <th>Imagen</th>
	        <th>Nombre</th>
	        <th class="text-right">Acciones</th>
	      </tr>
	    </thead>
	    <tbody>
	    <?php
	    $html = '';
	    foreach ($products as $product) {
	         $html ='
	         <tr>
		         <td><img height="150" width="150" 
		         alt="'.$product['nombre'].'" ';
		         if($product['imagen'] == "default2.jpg"){
		         	$html .= 'src="/assets/images/products/default2.jpg">';
                }else{
                    $html .= 'src="/assets/images/products/' . $product["ur"] . '/' . $product["imagen"].'">';
                }
		         $html .='</td>
		         <td>'.$product['nombre'].'</td>
		         <td class="text-right">
		          <a class="btn btn-default btn-sm" href="/panel/catalog/product/detail/'.$product['id'].'" >Ver</a>
		          <a class="btn btn-success btn-sm" href="/panel/catalog/product/edit/'.$product['id'].'" >Editar</a>
          		  <a class="btn btn-danger btn-sm removeNew" href="javascript:void(0);" data-id="'.$product['id'].'" >Eliminar</a>
		        </td>
	      	</tr>';

	      echo $html;
	    }
	    ?>
	    
	  </tbody>
	</table>
</div>