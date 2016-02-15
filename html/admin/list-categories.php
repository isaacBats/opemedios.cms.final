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

	<h3>Tipos</h3>
	  <table class="table table-bordered table-default table-striped nomargin">
	    <thead class="success">
	      <tr>
	        <th>Nombre</th>
	        <th class="text-right">Acciones</th>
	      </tr>
	    </thead>
	    <tbody>
	    <?php
	    foreach ($types as $type) {
	        echo '
	        <tr>
	         <td>'.$type['tipo'].'</td>
	         <td class="text-right">
	          <a class="btn btn-default btn-sm" href="/panel/catalog/type/'.str_replace(" ", "-",strtolower($type['tipo'])).'" >Ver</a>
	        </td>
	      </tr>';
	    }
	    ?>
	    
	  </tbody>
	</table>

	<h3>Usos</h3>
	  <table class="table table-bordered table-default table-striped nomargin">
	    <thead class="success">
	      <tr>
	        <th>Nombre</th>
	        <th class="text-right">Acciones</th>
	      </tr>
	    </thead>
	    <tbody>
	    <?php
	    foreach ($uses as $use) {
	        echo '
	        <tr>
	         <td>'.$use['uso'].'</td>
	         <td class="text-right">
	          <a class="btn btn-default btn-sm" href="/panel/catalog/use/'.str_replace(" ", "-", strtolower($use['uso'])).'" >Ver</a>
	        </td>
	      </tr>';
	    }
	    ?>
	    
	  </tbody>
	</table>
</div>