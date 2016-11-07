<div class="container row">
	<div class="perfil">
		<div class="empresa">
			<figure class="logo">
				<img src="/assets/data/empresas/<?= $_SESSION['user']['logo_empresa'] ?>">
			</figure>
			<h3>Bienvenid@: <?= $_SESSION['user']['usuario']?></h3>			
		</div>
		<div class="indicadores">
			<div class="totales">
				<ul>
					<li>
						<a href="">Noticias totales: 
							<strong>
								
							</strong>
						</a>
					</li>
					<li>
						<a href="">Noticias del mes: 
							<strong>
								
							</strong>
						</a>
					</li>
					<li>
						<a href="">Noticias de hoy: 
							<strong>
								
							</strong>
						</a>
					</li>
				</ul>				
			</div>
			<div class="fuentes">
				<strong>Noticias del mes: </strong>
				<ul>
					<li>
						<a href="">Televisión: 
							<strong>
								
							</strong>
						</a>
					</li>
					<li>
						<a href="">Radio: 
							<strong>
								
							</strong>
						</a>
					</li>
					<li>
						<a href="">Prensa: 
							<strong>
								
							</strong>
						</a>
					</li>
					<li>
						<a href="">Revista: 
							<strong>
								
							</strong>
						</a>
					</li>
					<li>
						<a href="">Internet: 
							<strong>
								
							</strong>
						</a>
					</li>
					<li>
						<a href="">Fuentes Monitoreadas: 
							<strong>
								
							</strong>
						</a>
					</li>
				</ul>
			</div>
		</div>				
	</div>
	<div class="row noticias">
		<article>
			<div class="media">
				
			</div>
			<div class="datos">
			</div>
		</article>
	</div>	
</div>
<?php echo '<pre>'; print_r($_SESSION); exit; ?>