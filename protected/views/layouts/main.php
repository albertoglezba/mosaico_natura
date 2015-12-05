<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="google-site-verification"
		  content="hpYzmQ5rXbuJAdCqhA1wBDY9GhKj2NrTLcJ28lnFp_c">
	<title>Mosaico Natura México</title>
	<meta name="keywords" content="Mosaico Natura México, Fotografía, Naturaleza, Banco de imágenes, Fauna, Flora, Paisajes y ecosistemas, Deterioro ambiental, Conservación, Formas y texturas, Aérea y acuática, Usos y costumbres">
	<link rel="icon" type="images/ico" href="http://www.mosaiconatura.net/images/favicon.ico">

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

	<script type="text/javascript" src="<?php echo $yii_path; ?>/js/jquery.easing.min.js"></script>
	<script type="text/javascript" src="<?php echo $yii_path; ?>/js/bootstrap.min.js.js"></script>

	<!-- Custom Theme JavaScript -->
	<script type="text/javascript" src="<?php echo $yii_path; ?>/js/grayscale.js"></script>

	<!-- Load the FileUpload Plugin (more info @ https://github.com/blueimp/jQuery-File-Upload) -->
	<script type="text/javascript" src="<?php echo $yii_path; ?>/js/jquery.fileupload.js"></script>
	<script type="text/javascript" src="<?php echo $yii_path; ?>/js/jquery.qtip.min.js"></script>
	<script type="text/javascript" src='http://maps.google.com/maps/api/js?libraries=places'></script>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Start of the Cascading Style Sheets -->
	<link rel="stylesheet" type="text/css" href="<?php echo $yii_path; ?>/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $yii_path; ?>/css/jquery.qtip.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $yii_path; ?>/css/style_aws.css">

	<!-- Custom Fonts -->
    <link rel="stylesheet" type="text/css" href="<?php echo $yii_path; ?>/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Montserrat:400,700">

</head>


<body>
<h4>Este menú lo está haciendo afernández, hay que adaptar el php a lo q ella entregue</h4>
<p>
	<?php
	if (!Yii::app()->user->isGuest)
	{
		if (!isset(Yii::app()->user->id_usuario) || empty(Yii::app()->user->id_usuario))
		{
			if (!isset(Yii::app()->user->id) || empty(Yii::app()->user->id))
			{
				Yii::app()->user->logout();
				echo CHtml::link('Inicia sesión', array('site/login'), array('style'=>'color:#FFD503;font-size:15px;'));
			} else {
				$this->setIdUsuario(Yii::app()->user->id);
				$usuario = Usuarios::model()->findByPk(Yii::app()->user->id_usuario);
				echo CHtml::link('Tus fotografías', array('fotos/index'), array('style'=>'color:#FFD503;font-size:15px;'));
				echo " | ".CHtml::link('Propiedades de tu cuenta', array('usuarios/'.$usuario->id), array('style'=>'color:#FFD503;font-size:15px;'));
				echo " | ".CHtml::link('Cerrar sesión('.Yii::app()->user->name.')', array('site/logout'), array('style'=>'color:#FFD503;font-size:15px;'));
			}
		} else {
			$usuario = Usuarios::model()->findByPk(Yii::app()->user->id_usuario);
			echo CHtml::link('Tus fotografías', array('fotos/index'), array('style'=>'color:#FFD503;font-size:15px;'));
			echo " | ".CHtml::link('Propiedades de tu cuenta', array('usuarios/'.$usuario->id), array('style'=>'color:#FFD503;font-size:15px;'));
			echo " | ".CHtml::link('Cerrar sesión('.Yii::app()->user->name.')', array('site/logout'), array('style'=>'color:#FFD503;font-size:15px;'));
		}
	} else
		echo CHtml::link('Inicia sesión', array('site/login'), array('style'=>'color:#FFD503;font-size:15px;'));
	echo " | ".CHtml::link('Preguntas frecuentes', 'http://www.mosaiconatura.net/preguntasFrecuentes.html', array('style'=>'color:#FFD503;font-size:15px;', 'target'=>'_blank'));
	?>
</p>
<?php echo $content; ?>
<p>Mosaico Natura <?php echo date('Y'); ?> <strong>|</strong><a href="mailto:mosaiconatura@conabio.gob.mx">mosaiconatura@conabio.gob.mx</a>
</p>
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
