<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<!-- If you delete this meta tag, the ground will open and swallow you. -->
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Bloque de noticias OPEMEDIOS</title>
	<style type="text/css">
		/* ------------------------------------- 
				GLOBAL 
		------------------------------------- */
		* { 
			margin:0;
			padding:0;
		}
		* { font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; }

		img { 
			max-width: 100%; 
		}
		.collapse {
			margin:0;
			padding:0;
		}
		body {
			-webkit-font-smoothing:antialiased; 
			-webkit-text-size-adjust:none; 
			margin: 0 auto;
			width: 80%!important; 
			height: 100%;
		}


		/* ------------------------------------- 
				ELEMENTS 
		------------------------------------- */
		a { color: #2BA6CB;}

		.btn {
			text-decoration:none;
			color: #FFF;
			background-color: #5bc0de;
    		border-color: #46b8da;
    		border-radius: 4px;
			padding:10px 16px;
			font-weight:bold;
			margin-right:10px;
			text-align:center;
			cursor:pointer;
			display: inline-block;
		}

		p.callout {
			padding:15px;
			background-color:#ECF8FF;
			margin-bottom: 15px;
		}
		.callout a {
			font-weight:bold;
			color: #2BA6CB;
		}

		table.social {
		/* 	padding:15px; */
			/*background-color: #ebebeb;*/
			
		}
		.social .soc-btn {
			border-radius: 10px;
			padding: 3px 7px;
			font-size:12px;
			margin-bottom:10px;
			text-decoration:none;
			color: #FFF;font-weight:bold;
			display:block;
			text-align:center;
		}
		a.fb { background-color: #3B5998!important; }
		a.tw { background-color: #1daced!important; }
		a.gp { background-color: #DB4A39!important; }
		a.ms { background-color: #000!important; }

		.sidebar .soc-btn { 
			display:block;
			width:100%;
		}

		/* ------------------------------------- 
				HEADER 
		------------------------------------- */
		table.head-wrap { width: 100%;}

		.header.container table td.logo { padding: 15px; }
		.header.container table td.label { padding: 15px; padding-left:0px;}


		/* ------------------------------------- 
				BODY 
		------------------------------------- */
		table.body-wrap { width: 100%;}


		/* ------------------------------------- 
				FOOTER 
		------------------------------------- */
		table.footer-wrap { width: 100%;	clear:both!important;
		}
		.footer-wrap .container td.content  p { border-top: 1px solid rgb(215,215,215); padding-top:15px;}
		.footer-wrap .container td.content p {
			font-size:10px;
			font-weight: bold;
			
		}


		/* ------------------------------------- 
				TYPOGRAPHY 
		------------------------------------- */
		h1,h2,h3,h4,h5,h6 {
		font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; line-height: 1.1; margin-bottom:15px; color:#000;
		}
		h1 small, h2 small, h3 small, h4 small, h5 small, h6 small { font-size: 60%; color: #6f6f6f; line-height: 0; text-transform: none; }

		h1 { font-weight:200; font-size: 44px;}
		h2 { font-weight:200; font-size: 37px;}
		h3 { font-weight:500; font-size: 27px;}
		h4 { font-weight:500; font-size: 23px;}
		h5 { font-weight:900; font-size: 17px;}
		h6 { font-weight:900; font-size: 14px; text-transform: uppercase; color:#444;}

		.collapse { margin:0!important;}

		p, ul { 
			margin-bottom: 10px; 
			font-weight: normal; 
			font-size:14px; 
			line-height:1.6;
		}
		p.lead { font-size:17px; }
		p.last { margin-bottom:0px;}

		ul li {
			margin-left:5px;
			list-style-position: inside;
		}

		/* ------------------------------------- 
				SIDEBAR 
		------------------------------------- */
		ul.sidebar {
			background:#ebebeb;
			display:block;
			list-style-type: none;
		}
		ul.sidebar li { display: block; margin:0;}
		ul.sidebar li a {
			text-decoration:none;
			color: #666;
			padding:10px 16px;
		/* 	font-weight:bold; */
			margin-right:10px;
		/* 	text-align:center; */
			cursor:pointer;
			border-bottom: 1px solid #777777;
			border-top: 1px solid #FFFFFF;
			display:block;
			margin:0;
		}
		ul.sidebar li a.last { border-bottom-width:0px;}
		ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p { margin-bottom:0!important;}



		/* --------------------------------------------------- 
				RESPONSIVENESS
				Nuke it from orbit. It's the only way to be sure. 
		------------------------------------------------------ */

		/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
		.container {
			display:block!important;
			max-width:600px!important;
			margin:0 auto!important; /* makes it centered */
			clear:both!important;
		}

		/* This should also be a block element, so that it will fill 100% of the .container */
		.content {
			padding:15px;
			max-width:600px;
			margin:0 auto;
			display:block; 
		}

		/* Let's make sure tables in the content area are 100% wide */
		.content table { width: 100%; }


		/* Odds and ends */
		.column {
			width: 300px;
			float:left;
		}
		.column tr td { padding: 15px; }
		.column-wrap { 
			padding:0!important; 
			margin:0 auto; 
			max-width:600px!important;
		}
		.column table { width:100%;}
		.social .column {
			width: 280px;
			min-width: 279px;
			float:left;
		}

		/* Be sure to place a .clear element after each set of columns, just to be safe */
		.clear { display: block; clear: both; }

		/* para el menu */
		.lista ul
		{
		   padding: 0;
		   margin: 0;
		}

		.lista li
		{
		   list-style-type: none;
		   display: inline;
		   padding-right: 5px;
		}

		/* Para header-ini */
		.header-ini{
		    background-color: rgba(255, 228, 196, 0.9);
		    color: white;
		    font-size: 40px;
		    margin-top: -20px;
		    text-align: center;
		    text-transform: uppercase;
		    padding: 18% 0;
		}

		.header-ini span{
			background-color: rgba(0,0,25,.2);
		    padding: 0 18%;
		    width: 100%;
		}

		.text-help{
			color: #a9a9a9;
    		font-size: 10px;
		}

		.copy{
			text-align: center;
    		font-size: 12px;
		}

		.copy a{
			text-decoration: none;
		}

		.social-networks{

		}

		/* ------------------------------------------- 
				PHONE
				For clients that support media queries.
				Nothing fancy. 
		-------------------------------------------- */
		@media only screen and (max-width: 600px) {
			
			a[class="btn"] { display:block!important; margin-bottom:10px!important; background-image:none!important; margin-right:0!important;}

			div[class="column"] { width: auto!important; float:none!important;}
			
			table.social div[class="column"] {
				width:auto!important;
			}

		}
	</style>
</head>
<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">
	<!-- HEADER -->
	<table class="head-wrap container" bgcolor="#bbdefb">
		<tr>
			<td></td>
			<td class="header container" align="">
				<!-- /content -->
				<div class="content">
					<table bgcolor="#bbdefb" >
						<tr>
							<td></td>
							<td><img src="http://<?= $_SERVER['HTTP_HOST'] ?>/assets/images/logo_110X40.png" style="float: right;" /></td>
							<!-- <td align="right"><h6 class="collapse">Newsletter</h6></td> -->
						</tr>
					</table>
				</div><!-- /content -->
			</td>
			<td></td>
		</tr>
	</table><!-- /HEADER -->
	<!-- BODY -->
	<table class="body-wrap" bgcolor="">
		<tr>
			<td></td>
			<td class="container" align="" bgcolor="#FFFFFF">
				<!-- content -->
				<div class="content">
					<table>
						<tr>
							<td>
								<div class="header-ini">
									<span>Noticias del día</span>
								</div>
								<!-- <h1><?php //echo $first['title']; ?></h1> -->
								<!-- <p class="lead"><?php //echo $first['extract'] ?></p> -->
								<!-- <p><img src="<?php //echo $first['logo_font'] ?>" /></p>-->
								<div class="lista">
									<ul>
										<li><a target="_blank" href="http://<?= $_SERVER['HTTP_HOST'] ?>/primeras-planas">Primeras planas</a></li> |
										<li><a target="_blank" href="http://<?= $_SERVER['HTTP_HOST'] ?>/portadas-financieras">Portadas Financieras</a></li> |
										<li><a target="_blank" href="http://<?= $_SERVER['HTTP_HOST'] ?>/columnas-financieras">Columnas Financieras</a></li> |
										<li><a target="_blank" href="http://<?= $_SERVER['HTTP_HOST'] ?>/columnas-politicas">Columnas Politicas</a></li> |
										<li><a target="_blank" href="http://<?= $_SERVER['HTTP_HOST'] ?>/cartones">Cartones</a></li>
									</ul>
								</div>
							</td>
						</tr>
					</table>
				</div><!-- /content -->
				<?php foreach ($noticias as $tema => $notis): ?>
					<h3><?= $tema ?></h3>
					<hr>
					<!-- content -->
					<?php foreach ($notis as $value): ?>
						<div class="content">
							<table bgcolor="">
								<tr>
									<!-- <td class="small" width="20%" style="vertical-align: top; padding-right:10px;"><img src="http://lorempixel.com/200/200/16/Font<?php //echo $value['logo_font'] ?>" /></td> -->
									<td>
										<h4><?= $value['title'] ?></h4>
										<p class=""><?= cortarTexto($value['extract'], 150) ?></p>
										<p>
											<small class="text-help">(
												<?= "{$value['fuente']}-{$value['seccion']}, " . 
													(empty($value['autor_seccion']) 
													? $value['autor'] 
													: $value['autor_seccion']) 
												?>			
											)</small>
										</p>
										<a href="http://<?= $_SERVER['HTTP_HOST'] ?>/media/<?= strtolower(without_accents($value['tipoFuente'])) .'/'. $value['id_new'] ?>" class="btn" target="_blank">Ver mas &raquo;</a>
									</td>
								</tr>
							</table>
						</div><!-- /content -->
					<?php endforeach; ?>
				<?php endforeach; ?>
				<div class="content" style="max-width: 25%; margin-top: 35px;">
					<!-- social & contact -->
					<table bgcolor="" class="social" width="100%">
						<tr>
							<td></td>
							<td>
								<p class="social-networks">
									<a href="https://www.facebook.com/Opemedios-586086271483511/" target="_blank" class="soc-btn fb">Facebook</a> 
									<a href="https://twitter.com/DeMonitoreo" target="_blank" class="soc-btn tw">Twitter</a> 
								</p>
							</td>
							<td></td>
						</tr>
					</table><!-- /social & contact -->
				</div><!-- /content -->
			</td>
			<td></td>
		</tr>
	</table><!-- /BODY -->
	<!-- FOOTER -->
	<table class="footer-wrap">
		<tr>
			<td></td>
			<td class="container">
				<!-- content -->
				<div class="content copy" style="margin-top: -25px;">
					<a href="http://opemedios.com.mx">Copyright &copy; 2016, Opemedios</a>
				</div><!-- /content -->
			</td>
			<td></td>
		</tr>
	</table>
	<!-- /FOOTER -->
</body>
</html>