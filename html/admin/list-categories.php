<div class="table-responsive">
	  <h3>Categorias</h3>
	  <table class="table table-bordered table-default table-striped nomargin">
	    <thead class="success">
	      <tr>
	        <th>Nombre</th>
	        <th class="text-right">Acciones</th>
	      </tr>
	    </thead>
	    <tbody>
	    <?php
	    foreach ($categories as $category) {
	        echo '
	        <tr>
	         <td>'.$category['categoria'].'</td>
	         <td class="text-right">
	          <a class="btn btn-default btn-sm" href="/panel/catalog/category/'.str_replace(" " , "-" ,strtolower($category['categoria']) ).'" >Ver</a>
	        </td>
	      </tr>';
	    }
	    ?>
	    
	  </tbody>
	</table>
</div>