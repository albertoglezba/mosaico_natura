<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="google-site-verification" content="hpYzmQ5rXbuJAdCqhA1wBDY9GhKj2NrTLcJ28lnFp_c">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<title>Mosaico Natura M&eacute;xico</title>
	<meta property="og:image" content="http://www.mosaiconatura.net/img/bg-intro.jpg" />
	
	<meta name="keywords" content="Mosaico Natura México, Fotografía, Naturaleza, Banco de imágenes, Fauna, Flora, Paisajes y ecosistemas, Deterioro ambiental, Conservación, Formas y texturas, Aérea y acuática, Usos y costumbres">
	
	<?php $yii_path = Yii::app()->request->baseUrl; ?>
	
	<!-- Start of the Cascading Style Sheets -->
	<!-- BOOTSTRAP Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" integrity="sha384-PmY9l28YgO4JwMKbTvgaS7XNZJ30MK9FAZjjzXtlqyZCqBY6X6bXIkM++IkyinN+" crossorigin="anonymous">
	<!-- BOOTSTRAP Optional theme -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap-theme.min.css" integrity="sha384-jzngWsPS6op3fgRCDTESqrEJwRKck+CILhJVO5VvaAZCq8JYf8HsR/HPpBOOPZfR" crossorigin="anonymous">
	
	<!-- LEAFLET -->
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin=""/>
	
	<link rel="stylesheet" type="text/css" href="<?php echo $yii_path; ?>/css/global.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $yii_path; ?>/css/overide.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $yii_path; ?>/css/jquery.qtip.min.css" />
	
	
	<!-- Custom Fonts -->
	<link rel="stylesheet" type="text/css" href="<?php echo $yii_path; ?>/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Montserrat:400,700">
	<link href="https://fonts.googleapis.com/css?family=Barlow+Condensed:400,500,600,800" rel="stylesheet">
	
	<link rel="icon" type="images/ico"	href="<?php echo $yii_path; ?>/favicon.ico">
	
	<!-- Start of the JavaScript -->
	<script type="text/javascript">
		function MM_preloadImages() { //v3.0
			var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
				var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
					if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
		}
	</script>
	
	<!-- Load jQuery & jQuery UI -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	
	<script type="text/javascript" src="<?php echo $yii_path; ?>/js/jquery.easing.min.js"></script>
	
	<!-- BOOTSTRAP Latest compiled and minified JavaScript -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js" integrity="sha384-vhJnz1OVIdLktyixHY4Uk3OHEwdQqPppqYR8+5mjsauETgLOcEynD9oPHhhz18Nw" crossorigin="anonymous"></script>
	
	<!-- LEAFLET -->
	<script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg==" crossorigin=""></script>
	<script type="text/javascript" src="<?php echo $yii_path; ?>/js/Control.Coordinates.js"></script>
	<script type="text/javascript" src="<?php echo $yii_path; ?>/js/geonames.js"></script>
	
	<!-- Custom Theme JavaScript -->
	<script type="text/javascript" src="<?php echo $yii_path; ?>/js/grayscale.js"></script>
	
	<!-- Load the FileUpload Plugin (more info @ https://github.com/blueimp/jQuery-File-Upload) -->
	<script type="text/javascript" src="<?php echo $yii_path; ?>/js/jquery.fileupload.js"></script>
	<script type="text/javascript" src="<?php echo $yii_path; ?>/js/jquery.qtip.min.js"></script>
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>


<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

<?php echo $yii_path ?>
<!-- Navigation -->
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
				<i class="fa fa-bars blanco"></i>
			</button>
			<a class="navbar-brand page-scroll" href="<?php echo $yii_path; ?>/index.php">
				<h2>MOSAICO NATURA M&Eacute;XICO</h2><img src="<?php echo $yii_path; ?>/img/logo-mosaiconatura.png" alt="Mosaico-Natura">
			</a>
		</div>
		
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-right navbar-main-collapse">
			<ul class="nav navbar-nav">
				<!-- Hidden li included to remove active class from about link when scrolled up past about section -->
				<li class="hidden">
					<a href="<?php echo $yii_path; ?>#page-top"></a>
				</li>
				<li>
					<a class="page-scroll" href="<?php echo $yii_path; ?>#about">Qui&eacute;nes somos</a>
				</li>
				<li>
					<a class="page-scroll" href="<?php echo $yii_path; ?>#bases">Concurso</a>
				</li>
				<li>
					<a class="page-scroll" href="<?php echo $yii_path; ?>#expos">Exposiciones</a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ganadores</a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo $yii_path; ?>/ganadores_anteriores.html#ganadores_2018">Ganadores del IV concurso</a></li>
						<li><a href="<?php echo $yii_path; ?>/ganadores_anteriores.html#ganadores_2017">Ganadores del III concurso</a></li>
						<li><a href="<?php echo $yii_path; ?>/ganadores_anteriores.html#ganadores_2016">Ganadores del II concurso</a></li>
						<li><a href="<?php echo $yii_path; ?>/ganadores_anteriores.html#ganadores_2015">Ganadores del I concurso</a></li>
					</ul>
				</li>
				<li>
					<a class="page-scroll" href="<?php echo $yii_path; ?>#registro">Registro</a>
				</li>
				<li>
					<a class="page-scroll" href="<?php echo $yii_path; ?>#medios">Medios</a>
				</li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container -->
</nav>

<?php if (Yii::app()->request->pathInfo != '' && Yii::app()->request->pathInfo != 'site/index'){ ?>
	
	<section id="registro" class="content-section text-center">
		<div class="registro-header">
			<div class="container">
				<div class="col-lg-8 col-lg-offset-2">
					
					<?php $ruta = explode('/', Yii::app()->request->pathInfo) ?>
					<?php if($ruta[0] == 'fotos' || $ruta[0] == 'videos') { ?>
						<h2><?php echo strtoupper($ruta[0]); ?></h2>
					<?php } else if($ruta[0] == 'usuarios' && (Int)$ruta[1] !== 0) { ?>
						<h2>CUENTA</h2>
					<?php } else if($ruta[1] == 'terminos_condiciones'){ ?>
						<h2>TÉRMINOS Y CONDICIONES</h2>
					<?php } else { ?>
						<h2>REGISTRO</h2>
					<?php } ?>
				</div>
			</div>
		</div>
		
		<div class="registro-content row">
			<div class="col-md-8 col-md-offset-2">
				<?php
					if (!Yii::app()->user->isGuest){
						if (!isset(Yii::app()->user->id_usuario) || empty(Yii::app()->user->id_usuario)){
							if (!isset(Yii::app()->user->id) || empty(Yii::app()->user->id)){
								Yii::app()->user->logout();
								echo CHtml::link('Inicia sesión', array('site/login'));
							}else{
								$this->setIdUsuario(Yii::app()->user->id);
								$usuario = Usuarios::model()->findByPk(Yii::app()->user->id_usuario);
								echo "<div class='btn-group montserrat' role='group' aria-label='...'>";
								echo CHtml::link("Tus fotografías <span class='glyphicon glyphicon-camera' aria-hidden='true'></span>", array('fotos/index'), array('class'=>'btn btn-default'));
								echo CHtml::link("Propiedades de tu cuenta <span class='glyphicon glyphicon-cog' aria-hidden='true'></span>", array('usuarios/'.$usuario->id), array('class'=>'btn btn-default'));
								echo CHtml::link("Cerrar sesión <small>(".Yii::app()->user->name.")</small> <span class='glyphicon glyphicon-log-out' aria-hidden='true'></span>", array('site/logout'),
									array('class'=>'btn btn-default'));
								echo "</div>";
							}
						}else{
							$usuario = Usuarios::model()->findByPk(Yii::app()->user->id_usuario);
							echo "<div class='btn-group montserrat' role='group' aria-label='...'>";
							echo CHtml::link("Tus fotografías <span class='glyphicon glyphicon-camera' aria-hidden='true'></span>", array('fotos/index'), array('class'=>'btn btn-default'));
							echo CHtml::link("Propiedades de tu cuenta <span class='glyphicon glyphicon-cog' aria-hidden='true'></span>", array('usuarios/'.$usuario->id), array('class'=>'btn btn-default'));
							echo CHtml::link("Cerrar sesión <small>(".Yii::app()->user->name.")</small> <span class='glyphicon glyphicon-log-out' aria-hidden='true'></span>", array('site/logout'),
								array
							('class'=>'btn btn-default'));
							echo "</div>";
						}
					}else{?>
					
					<?php }?>
				<?php echo $content; ?>
			</div>
		</div>
	
	</section>
<?php } else { echo $content; } ?>


<!-- Footer -->

<div id="colaboradores">
	<div class="container">
		
		<div class="row">
		<div class="col-xs-4 col-md-2 col-lg-2 sponsers">
			<a href="http://www.gob.mx/conabio/" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo_conabio.jpg" alt="Conabio" class="img-responsive"></a>
		</div>
		<div class="col-xs-4 col-md-2 col-lg-2 sponsers">
			<a href="https://www.gob.mx/conanp" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo_conanp.jpg" alt="Comisión Nacional de Áreas Naturales Protegidas" class="img-responsive"></a>
		</div>
		<div class="col-xs-4 col-md-2 col-lg-2 sponsers">
			<a href=""><img src="<?php echo $yii_path; ?>/img/logo_fundacion_cr.jpg" alt="Fundación Claudia y Roberto Hernández" class="img-responsive"></a>
		</div>
		<div class="col-xs-3 col-md-2 col-lg-2 sponsers">
			<a href="https://epson.com.mx/" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo_epson.jpg" alt="Epson" class="img-responsive"></a>
		</div>
		<div class="col-xs-6 col-md-4 col-lg-4 sponsers">
			<a href="http://www.sedema.cdmx.gob.mx/" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo_secmedioam_cdmx.jpg" alt="SEDEMA" class="img-responsive"></a>
		</div>

			
		<div class="col-xs-4 col-md-2 col-lg-2 sponsers">
			<a href="https://fmcn.org/" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo_fondo.jpg" alt="Fondo Mexicano para la Conservación" class="img-responsive"></a>
		</div>
		<div class="col-xs-4 col-md-2 col-lg-2 sponsers">
			<a href="https://www.nationalgeographic.com/" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo_natgeo.jpg" alt="National Geographic" class="img-responsive"></a>
		</div>
		<div class="col-xs-4 col-md-2 col-lg-2 sponsers">
			<a href="http://www.ngenespanol.com/" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo_natgeo_esp.jpg" alt="National Geographic en español" class="img-responsive"></a>
		</div>
		<div class="col-xs-4 col-md-1 col-lg-1 sponsers">
			<a href="http://www.fundacionacir.org.mx/" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo_fundacion_acir.jpg" alt="Fundación Acir" class="img-responsive"></a>
		</div>
		<div class="col-xs-4 col-md-1 col-lg-1 sponsers">
			<a href="https://www.teleurban.tv" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo_teleurban.jpg" alt="Tele Urban" class="img-responsive"></a>
		</div>
		<div class="col-xs-4 col-md-1 col-lg-1 sponsers">
			<a href="https://www.biodiversidad.gob.mx/especies/Invasoras/proyecto.html" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo_gef.jpg" alt="gef" sclass="img-responsive"></a>
		</div>
		<div class="col-xs-4 col-md-1 col-lg-1 sponsers">
			<a href="http://www.mx.undp.org" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo_pnud.jpg" alt="PNUD" class="img-responsive"></a>
		</div>
		<div class="col-xs-4 col-md-2 col-lg-2 sponsers">
			<a href="http://www.mexicanisimo.com.mx" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo_mexicanisimo.jpg" alt="Mexicanísimo" class="img-responsive"></a>
		</div>
		</div>
		
	</div>
</div>


<footer id="enlaces">
	<div class="container">
		<div class="col-md-3">
			<p>NUESTROS COLABORADORES</p>
			<ul>
				<li><a href="http://www.gob.mx/conabio/" target="_blank"><span class="conabio">Conabio</span></a></li>
				<li><a href="https://fmcn.org/" target="_blank">Fondo Mexicano para la Conservación de la Naturaleza</a></li>
				<li style="color: white">Fundación Claudia y Roberto Hernández</li>
				<li><a href="https://epson.com.mx/" target="_blank">Epson</a></li>
				<li><a href="http://www.sedema.cdmx.gob.mx/" target="_blank">Secretaría del Medio Ambiente</a></li>
				<li><a href="https://www.nationalgeographic.com/" target="_blank">National Geographic</a> </li>
				<li><a href="http://www.ngenespanol.com/" target="_blank">National Geographic en Espa&ntilde;ol</a></li>
				<li><a href="http://www.fundacionacir.org.mx/" target="_blank">Fundaci&oacute;n ACIR</a></li>
				<li><a href="https://www.teleurban.tv" target="_blank">Tele Urban</a></li>
				<li><a href="https://www.biodiversidad.gob.mx/especies/Invasoras/proyecto.html" target="_blank">gef</a></li>
				<li><a href="http://www.mx.undp.org" target="_blank">PNUD</a></li>
				<li><a href="http://www.mexicanisimo.com.mx" target="_blank">Mexicanísimo</a></li>
			</ul>
		</div>
		<div class="col-md-3">
			<p>S&Iacute;GUENOS</p>
			<ul>
				<li><a href="https://www.facebook.com/conabio/">Facebook</a></li>
				<li><a href="https://twitter.com/conabio">Twitter</a></li>
				<li><a href="https://www.instagram.com/biodiversidad_mexicana/">Instagram</a></li>
				<li><a href="https://www.youtube.com/user/biodiversidadmexico">YouTube</a></li>
				<li><a href="https://www.vimeo.com/conabio">Vimeo</a></li>
				<li><a href="https://soundcloud.com/conabio">SoundCloud</a></li>
			</ul>
		
		</div>
		<div class="col-md-3">
			<p>CONOCE</p>
			<ul>
				<li><a href="http://www.naturalista.mx/">Naturalista</a></li>
				<li><a href="http://biodiversidad.gob.mx/">Biodiversidad Mexicana</a></li>
				<li><a href="http://www.enciclovida.mx/">EncicloVida</a></li>
			</ul>
		</div>
		<div class="col-md-3">
			<p>LEGAL</p>
			<ul>
				<li><a href="<?php echo Yii::app()->baseUrl;?>/index.php/site/terminos_condiciones">T&eacute;rminos y condiciones</a></li>
			</ul>
		</div>
	</div>
</footer>
<footer id="copyright">
	<div class="container text-center">
		<p style="color: gray">Copyright &copy; Mosaico Natura <?php echo date('Y'); ?> | <a href="mailto:mosaiconatura@conabio.gob.mx">mosaiconatura@conabio.gob.mx</a></p>
	</div>
</footer>

<!--Adobe font-->
<script src="https://use.typekit.net/uhe3shv.js"></script>
<script>try{Typekit.load({ async: false });}catch(e){}</script>

<!-- Código para estadísticas en Google Analytics -->
<script src="http://bdi.conabio.gob.mx/fotoweb/googleAnalytics.js"></script>
<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-8226401-8']);
	_gaq.push(['_trackPageview']);
	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
</script>

</body>
</html>
