<div class="search-box">
    	<form action="/search" id="frmBuscar" novalidate="novalidate" method="POST" >
    	   	<input type="text"  onfocus="activateSearch()" , onblur="deactivateSearch( 1000 )"
    	   	autocomplete="off" maxlength="50" id="q" name="q" placeholder="<?php echo $this->trans($lang , "Búsqueda" , "Search") ;?>" class="text-label" onkeyup="getSearch( this.value );">
    	   	<div id="autocomplete">
    	   		<ul></ul>
    	   	</div>
            <input type="submit" title="Buscar" value="<?php echo $this->trans($lang , "Buscar" , "Search") ;?>" name="buscar">
			<div class="listadoProductosAutoCompletar" id="listadoProductosAutoCompletar"></div>
           	<div style="clear:both;"></div>
        </form>     
</div><!-- .search-box -->