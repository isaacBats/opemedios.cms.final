<div class="search-box">
    	<form action="/catalog/browser" id="frmBuscar" novalidate="novalidate" method="POST" >
    	   	<input type="text" autocomplete="off" maxlength="50" id="q" name="q" placeholder="Búsqueda" class="text-label" onkeyup="getSearch( this.value );">
    	   	<div id="autocomplete"></div>
            <input type="submit" title="Buscar" value="Buscar" name="buscar">
			<div class="listadoProductosAutoCompletar" id="listadoProductosAutoCompletar"></div>
           	<div style="clear:both;"></div>
        </form>     
</div><!-- .search-box -->