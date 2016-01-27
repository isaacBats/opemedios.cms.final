<?php


/**
*  Controlador de noticias
*/

class Noticias extends Controller
{
	
	private function slugs(){
		$sql = "SELECT slug FROM noticias";
		$query = $this->pdo->prepare($sql);
		$rs = $query->execute();
		if($rs!==false){
			$nr = $query->rowCount();
			if( $nr > 0 ){
				$slugs = $query->fetchAll(PDO::FETCH_COLUMN);
				return $slugs;
			}
		}
	}

	function navegacion($lang="es",$slug){
		
		$slugs = $this->slugs();

		/************************************************************************************/
		$key_actual = array_search($slug, $slugs);	
		$key_final = key( array_slice( $slugs, -1, 1, TRUE ) );
		/************************************************************************************/

		$anterior = ( ($key_actual-1) < 0 ) ? '<a href="'.$slugs[$key_final].'">'.$this->trans($lang,'Anterior','Previous').'</a>' : '<a href="'.$slugs[$key_actual-1].'">'.$this->trans($lang,'Anterior','Previous').'</a>';
		$siguiente = ( ($key_actual+1) > $key_final ) ? '<a href="'.$slugs[0].'">'.$this->trans($lang,'Siguiente','Next').'</a>' : '<a href="'.$slugs[$key_actual+1].'">'.$this->trans($lang,'Siguiente','Next').'</a>';
		
		$html =  $anterior.' | '.$siguiente;
		
		return $html;
	}

	/**
	 * Devuelve el detalle de la noticia
	 * @param string $lang 
	 * @param integer $id 
	 * @return string
	 */
	function mostrarDetalle($lang="es", $slug=""){
		if ( !empty($slug) ){

			$html = '';

			$sql = "SELECT * FROM noticias WHERE slug = :slug";
			$query = $this->pdo->prepare($sql);
			$query->bindParam(':slug', $slug);
			$rs = $query->execute();
			if( $rs ){
				$noticia = $query->fetch();
				if( $lang == "en" ){
					$html .= '<div class="registro">
					    	<div class="evento-principal full">
						        <a href="javascript:void(0)" class="fancybox">
						            <img alt="" src="/assets/images/news/'.$noticia['imagen'].'" />
						        </a>
					    	</div><!-- .evento-principal -->
					    	<div class="eventoSecundario">
						        <div class="nav-detalle">
						            '.$this->navegacion($lang,$noticia['slug']).'
						            <a href="'.$this->url($lang,'/news').'" class="ver-todos">Show all</a>
						        </div>
					  			<!-- nav-detalle -->
						        <h2 class="detalle-producto">'.$noticia['titulo_en'].'</h2>
						        '.$noticia['contenido_en'].'
							</div>
							<!-- .eventoSecundario -->

						</div>';
				}
				else{
					$html .= '<div class="registro">
					    	<div class="evento-principal full">
						        <a href="javascript:void(0)" class="fancybox">
						            <img alt="" src="/assets/images/news/'.$noticia['imagen'].'" />
						        </a>
					    	</div><!-- .evento-principal -->
					    	<div class="eventoSecundario">
						        <div class="nav-detalle">
						            '.$this->navegacion($lang,$noticia['slug']).'
						            <a href="'.$this->url($lang,'/news').'" class="ver-todos">Ver todos</a>
						        </div>
					  			<!-- nav-detalle -->
						        <h2 class="detalle-producto">'.$noticia['titulo'].'</h2>
						        '.$noticia['contenido'].'
							</div>
							<!-- .eventoSecundario -->

						</div>';
				}
			}

			$this->addbread( array("url"=>"/news" , "label"=>"News ") );
			$this->addbread( array( "label"=>$noticia['titulo']) );

			$this->header($lang);

			
		}
		else{

		}
		
		echo $html;
		$this->footer( $lang );
	}
	
	/**
	 * Este es el template base para las funciones
	 * @param string $lang 
	 * @return string
	 */
	function mostrarTodas($lang="es"){
		
		$html = '';
		
		

		if ($lang == "es"){
			$this->addBread(array("label"=>"Noticias"));
			$sql = "SELECT * FROM noticias";
			$query = $this->pdo->prepare($sql);
			$rs = $query->execute();
			if($rs!==false){
				$nr = $query->rowCount();
				if( $nr > 0 ){
					$noticias = $query->fetchAll();
					foreach ($noticias as $noticia) {
						$html .= '<div class="listado">
									<div class="list-item">
						                <div class="img-listado">
											<a href="'.$this->url($lang,'/news/'.$noticia['slug']).'">
						                    	<img src="/assets/images/news/'.$noticia['imagen_thumbnail'].'" alt="">
											</a>
						                </div>
						                <div class="texto-listado">
						                    <a href="'.$this->url($lang,'/news/'.$noticia['slug']).'"><h2>'.$noticia['titulo'].'</h2></a>
						                    '.$noticia['extracto'].'
						                    <p>
						                    	<a href="'.$this->url($lang,'/news/'.$noticia['slug']).'">[ + ] Leer más </a>
						                    </p>
						                </div>
						                <br class="clear">
						            </div>
						         </div>';
					}
				}
			}
		}
		else if ($lang == "en") {
			$this->addBread(array("label"=>"News"));
			$sql = "SELECT * FROM noticias";
			$query = $this->pdo->prepare($sql);
			$rs = $query->execute();
			if($rs!==false){
				$nr = $query->rowCount();
				if( $nr > 0 ){
					$noticias = $query->fetchAll();
					foreach ($noticias as $noticia) {
						$html .= '<div class="listado">
									<div class="list-item">
						                <div class="img-listado">
											<a href="'.$this->url($lang,'/news/'.$noticia['slug']).'">
						                    	<img src="/assets/images/news/'.$noticia['imagen_thumbnail'].'" alt="">
											</a>
						                </div>
						                <div class="texto-listado">
						                    <a href="'.$this->url($lang,'/news/'.$noticia['slug']).'"><h2>'.$noticia['titulo_en'].'</h2></a>
						                    '.$noticia['extracto_en'].'
						                    <p>
						                    	<a href="'.$this->url($lang,'/news/'.$noticia['slug']).'">[ + ] Read more </a>
						                    </p>
						                </div>
						                <br class="clear">
						            </div>
						         </div>';
					}
				}
			}
		}
		else
		{
			$html .= 'No existe lang';
		}

		$this->header($lang);
		echo $html;
		$this->footer( $lang );
	}

}

