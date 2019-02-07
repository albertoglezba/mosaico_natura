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

	<meta name="keywords" content="Mosaico Natura México, Fotografía, Naturaleza, Banco de imágenes, Fauna, Flora, Paisajes y ecosistemas, Deterioro ambiental, Conservación, Formas y texturas, Aérea y acuática, Usos y costumbres">

	<?php $yii_path = Yii::app()->request->baseUrl; ?>

	<!-- Start of the JavaScript -->


	<script type="text/javascript">
		function MM_preloadImages() { //v3.0
			var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
				var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
					if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
		}
	</script>
	<!-- Load jQuery & jQuery UI (Needed for the FileUpload Plugin) -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCM-wnXVHglXfilewWwsFUBgPRkKtW5XpU&libraries=places"></script>

	<script type="text/javascript" src="<?php echo $yii_path; ?>/js/jquery.easing.min.js"></script>
	<script type="text/javascript" src="<?php echo $yii_path; ?>/js/bootstrap.min.js"></script>

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

	<!-- Start of the Cascading Style Sheets -->
	<link rel="stylesheet" type="text/css" href="<?php echo $yii_path; ?>/css/style_aws.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $yii_path; ?>/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $yii_path; ?>/css/bootstrap-theme.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $yii_path; ?>/css/grayscale.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $yii_path; ?>/css/overide.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $yii_path; ?>/css/jquery.qtip.min.css" />


	<!-- Custom Fonts -->
	<link rel="stylesheet" type="text/css" href="<?php echo $yii_path; ?>/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Montserrat:400,700">
	<link href="https://fonts.googleapis.com/css?family=Barlow+Condensed:400,500,600,800" rel="stylesheet">

	<link rel="icon" type="images/ico"	href="http://www.mosaiconatura.net/favicon.ico">
</head>


<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

<?php echo $yii_path ?>
<!-- Navigation -->
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
				<i class="fa fa-bars"></i>
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
					<a class="page-scroll" href="<?php echo $yii_path; ?>/#about">Qui&eacute;nes somos</a>
				</li>
				<li>
					<a class="page-scroll" href="<?php echo $yii_path; ?>/#bases">Concurso</a>
				</li>
				<li style="display: none">
					<a class="page-scroll" href="<?php echo $yii_path; ?>/#jurado">Jurado</a>
				</li>
				<li>
					<a class="page-scroll" href="<?php echo $yii_path; ?>/#expos">Exposiciones</a>
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
				<li style="display: none">
					<a class="page-scroll" href="<?php echo $yii_path; ?>/#preguntas">Preguntas Frecuentes</a>
				</li>
				<li>
					<a class="page-scroll" href="<?php echo $yii_path; ?>/#registro">Registro</a>
				</li>
				<li>
					<a class="page-scroll" href="<?php echo $yii_path; ?>/#medios">Medios</a>
				</li>
				<!-- Trigger the modal with a button
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->
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

		<div class="registro-content">
			<div class="container">
				<div class="col-md-12">
					<p>
						<?php
						if (!Yii::app()->user->isGuest)
						{
							if (!isset(Yii::app()->user->id_usuario) || empty(Yii::app()->user->id_usuario))
							{
								if (!isset(Yii::app()->user->id) || empty(Yii::app()->user->id))
								{
									Yii::app()->user->logout();
									echo CHtml::link('Inicia sesión', array('site/login'));
								} else {
									$this->setIdUsuario(Yii::app()->user->id);
									$usuario = Usuarios::model()->findByPk(Yii::app()->user->id_usuario);
									echo "<div class='btn-group' role='group' aria-label='...'>";
									echo CHtml::link('Tus fotografías', array('fotos/index'), array('class'=>'btn btn-primary disabled'));
									echo CHtml::link('Tus videos', array('videos/index'), array('class'=>'btn btn-primary'));
									echo CHtml::link('Propiedades de tu cuenta', array('usuarios/'.$usuario->id), array('class'=>'btn btn-warning'));
									echo CHtml::link('Cerrar sesión ('.Yii::app()->user->name.')', array('site/logout'), array('class'=>'btn btn-danger'));
									echo "</div>";
								}
							} else {
								$usuario = Usuarios::model()->findByPk(Yii::app()->user->id_usuario);
								echo "<div class='btn-group' role='group' aria-label='...'>";
								echo CHtml::link('Tus fotografías', array('fotos/index'), array('class'=>'btn btn-primary disabled'));
								echo CHtml::link('Tus videos', array('videos/index'), array('class'=>'btn btn-primary'));
								echo CHtml::link('Propiedades de tu cuenta', array('usuarios/'.$usuario->id), array('class'=>'btn btn-warning'));
								echo CHtml::link('Cerrar sesión ('.Yii::app()->user->name.')', array('site/logout'), array('class'=>'btn btn-danger'));
								echo "</div>";
							}
						} else{?>

						<?php }?>
					</p>


					<?php echo $content; ?>

				</div>
			</div>
		</div>

	</section>
<?php } else { echo $content; } ?>


<!-- Footer -->

<div id="colaboradores">
	<div class="container">
		<div class="row">
			<div class="col-xs-4 col-md-3 col-lg-3 sponsers">
				<a href="http://www.gob.mx/conabio/" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo-conabio_2019.png" class="img-responsive" alt="Conabio"> </a>
			</div>
			<div class="col-xs-4 col-md-3 col-lg-3 sponsers"><a href="https://fmcn.org/" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo-fmcn-web-4.png" alt="Fondo Mexicano para la Conservación" class="img-responsive"> </a>
			</div>
			<div class="col-xs-4 col-md-2 col-lg-2 sponsers">
				<a href="https://www.nationalgeographic.com/" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo-natgeo.png" alt="National Geographic" class="img-responsive" > </a>
			</div>
			<div class="col-xs-4 col-md-2 col-lg-2 sponsers">
				<a href="http://www.ngenespanol.com/" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo-natgeo-esp.png" alt="National Geographic en español" class="img-responsive" > </a>
			</div>
			<div class="col-xs-4 col-md-2 col-lg-2 sponsers">
				<a href="http://www.fundacionacir.org.mx/" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo-acir.png" class="img-responsive img-gde" alt="Fundación Acir" > </a>
			</div>
			<!--
			<div class="col-xs-4 col-md-3 col-lg-2 sponsers">
				<a href="http://www.nikon.com.mx/" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo-nikon.png" class="img-responsive img-gde" alt="Nikon" > </a>
			</div>
			<div class="col-xs-4 col-md-3 col-lg-2 sponsers">
				<a href="https://epson.com.mx/" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo-epson.png" class="img-responsive img-ch" alt="Epson" > </a>
			</div>

			
			<div class="col-xs-4 col-md-3 col-lg-2 sponsers">
				<a href="http://http://cuartoscuro.com.mx/" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo-cuartoscuro.png" class="img-responsive" alt="Cuartoscuro" > </a>
			</div>
			<div class="col-xs-4 col-md-3 col-lg-2 sponsers">
				<a href="http://www.mexicanisimo.com.mx/" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo-mexicanisimo.png" class="img-responsive img-ch" alt="Mexicanísimo"> </a>
			</div>
			<div class="col-xs-4 col-md-3 col-lg-2 sponsers">
				<a href="http://http://buceoxtabay.com/" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo-xtabay.png" class="img-responsive img-gde" alt="Xtabay" > </a>
			</div>
			<div class="col-xs-4 col-md-3 col-lg-2 sponsers">
				<a href="http://www.doradobuceo.com/" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo-dorado-buceo.png" class="img-responsive" alt="Dorado Buceo"> </a>
			</div>
			<div class="col-xs-4 col-md-3 col-lg-2 sponsers">
				<a href="http://www.espacioprofundo.com.mx/" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo-espacio-profundo.png" class="img-responsive img-gde" alt="Espacio Profundo" > </a>
			</div>
			<div class="col-xs-4 col-md-3 col-lg-2 sponsers">
				<a href="http://www.lemusunderwaterschool.com/" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo-lemus.png" class="img-responsive" alt="Lemus" > </a>
			</div>
			<div class="col-xs-4 col-md-3 col-lg-2 sponsers">
				<a href="https://www.mexikoo.com" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo-mexikoo.png" class="img-responsive" alt="Mexikoo" > </a>
			</div>
			<div class="col-xs-4 col-md-3 col-lg-2 sponsers">
				<a href="https://www.rci.com" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo-rci.png" class="img-responsive" alt="RCI" > </a>
			</div>
			
			<div class="col-xs-4 col-md-6 col-lg-6 sponsers">
				<a href="http://www.cenart.gob.mx/" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo-cultura-cenart.png" class="img-responsive img-ch" alt="CENART" > </a>
			</div>
			<div class="col-xs-4 col-md-3 col-lg-3 sponsers">
				<a href="http://www.sedema.cdmx.gob.mx/" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo-sedema.png" class="img-responsive img-xch" alt="SEDEMA"> </a>
			</div>
			<div class="col-xs-4 col-md-3 col-lg-3 sponsers">
				<a href="https://www.gob.mx/conanp" target="_blank"><img src="<?php echo $yii_path; ?>/img/logo-conanp.png" class="img-responsive img-ch" alt="CONANP" > </a>
			</div>
			-->
			
			
			

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
				<li><a href="https://www.nationalgeographic.com/" target="_blank">National Geographic</a> </li>
				<li><a href="http://www.ngenespanol.com/" target="_blank">National Geographic en Espa&ntilde;ol</a></li>
				<li><a href="http://www.fundacionacir.org.mx/" target="_blank">Fundaci&oacute;n ACIR</a></li>
				<!--
				<li><a href="http://www.nikon.com.mx/" target="_blank">Nikon</a></li>
				<li><a href="https://epson.com.mx/" target="_blank">Epson</a></li>
				<li><a href="http://http://cuartoscuro.com.mx/" target="_blank">CUARTOSCURO</a></li>
				<li><a href="http://www.mexicanisimo.com.mx/" target="_blank">Mexican&iacute;simo</a></li>
				<li><a href="http://http://buceoxtabay.com/" target="_blank">Buceo Xtabay</a></li>
				<li><a href="http://www.doradobuceo.com/" target="_blank">Dorado Buceo</a></li>
				<li><a href="http://http://www.espacioprofundo.com.mx/" target="_blank">Espacio Profundo</a></li>
				<li><a href="http://http://www.lemusunderwaterschool.com/" target="_blank">Lemus Underwater School</a></li>
				<li><a href="https://www.mexikoo.com" target="_blank">Mexikoo</a></li>
				<li><a href="https://www.rci.com" target="_blank">RCI</a></li>
				<li><a href="http://www.sedema.cdmx.gob.mx/" target="_blank">CDMX</a></li>
				<li><a href="https://www.gob.mx/cultura" target="_blank">Secretar&iacute;a de cultura</a></li>
				<li><a href="http://www.cenart.gob.mx/" target="_blank">CENART</a></li>
				<li><a href="https://www.gob.mx/conanp" target="_blank">CONANP</a></li>
				-->
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
		<p>Copyright &copy; Mosaico Natura <?php echo date('Y'); ?> | <a href="mailto:mosaiconatura@conabio.gob.mx">mosaiconatura@conabio.gob.mx</a></p>
	</div>
</footer>

<!-- Código para estadísticas en Google Analytics -->
<map name="Map">
	<area shape="rect" coords="682,3,896,213" href="<?php echo Yii::app()->baseUrl."/index.php/fotos/create"; ?>">
	<area shape="rect" coords="724,218,853,269" href="<?php echo Yii::app()->baseUrl."/index.php/usuarios/create"; ?>">
	<area shape="rect" coords="7,5,674,265" href="<?php echo Yii::app()->baseUrl."/"; ?>">
</map>

<!--Adobe font-->
<script src="https://use.typekit.net/uhe3shv.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>

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
<!-- InstanceEnd -->
</html>
