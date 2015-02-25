<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//ES">
<!-- saved from url=(0042)http://www.mosaiconatura.net/concurso.html -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta name="google-site-verification"
	content="hpYzmQ5rXbuJAdCqhA1wBDY9GhKj2NrTLcJ28lnFp_c">
<title>Mosaico Natura México</title>
<meta name="keywords"
	content="Mosaico Natura México, Fotografía, Naturaleza, Banco de imágenes, Fauna, Flora, Paisajes y ecosistemas, Deterioro ambiental, Conservación, Formas y texturas, Aérea y acuática, Usos y costumbres">
<link rel="icon" type="images/ico"
	href="http://www.mosaiconatura.net/images/favicon.ico">
<link rel="stylesheet" type="text/css"
	href="http://www.mosaiconatura.net/estilos.css">
<script type="text/javascript" async=""
	src="http://www.mosaiconatura.net/ga.js"></script>
<script type="text/javascript" async=""
	src="http://www.mosaiconatura.net/ga.js"></script>
<script src="http://www.mosaiconatura.net/googleAnalytics.js"></script>
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>


<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css"
	media="print" />
<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.qtip.min.css" />
	
<script type="text/javascript">
var YII_PATH = "<?php echo Yii::app()->request->baseUrl; ?>";
</script>

<script type="text/javascript"
	src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript"
	src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.qtip.min.js"></script>
<link href="/css/estilosgral.css" rel="stylesheet" type="text/css">
</head>


<BODY>
	<table width="990" border="0" align="center" cellpadding="0"
		cellspacing="0">
		<tbody>
			<tr>
				<td width="200" align="center" bgcolor="#000000"><a
					href="http://www.mosaiconatura.net/index.html"><img
						src="http://www.mosaiconatura.net/images/logo_mosaicon_natura.png"
						width="153" height="79" border="0"> </a></td>
				<td width="790" align="center" bgcolor="#FFFFFF"><img
					src="http://www.mosaiconatura.net/images/barraLogos.png" width="804"
					height="79"></td>
			</tr>
			<tr>
				<td colspan="2" bgcolor="#333333">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3" align="center" valign="top" bgcolor="#333333">
					<table width="900" border="0" cellpadding="0" cellspacing="0">
						<tbody>
							<tr>
								<td valign="bottom"><table width="100%" border="0"
										cellspacing="0" cellpadding="0">
										<tbody>
											<tr>
												<td width="100%" height="70" align="left" valign="middle"
													bgcolor="#333333"><p class="titulo">
														<img
															src="http://www.mosaiconatura.net/images/pleca_concurso2.png"
															width="895" height="270" usemap="#Map">
													</p>
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
													</td>
											</tr>
											
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td height="20" colspan="3" bgcolor="#333333">&nbsp;</td>
			</tr>
			<tr>
				<td height="20" colspan="2" align="right" class="negrop">Mosaico
					Natura <?php echo date('Y'); ?> <strong>|</strong> <a
					href="mailto:mosaiconatura@conabio.gob.mx" style="color: #333333">mosaiconatura@conabio.gob.mx</a>
				</td>
			</tr>
			<tr>
				<td height="20" colspan="2" align="right">&nbsp;</td>
			</tr>
		</tbody>
	</table>

	<!-- CÃ³digo para estadÃ­sticas en Google Analytics -->
<map name="Map">
  <area shape="rect" coords="682,3,896,213" href="<?php echo Yii::app()->baseUrl."/index.php/fotos/create"; ?>">
  <area shape="rect" coords="724,218,853,269" href="<?php echo Yii::app()->baseUrl."/index.php/usuarios/create"; ?>">
  <area shape="rect" coords="7,5,674,265" href="<?php echo Yii::app()->baseUrl."/"; ?>">
</map>

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
<?php //echo md5("FernandaRuiz|5741974"); ?>
	<!-- Fin de CÃ³digo -->
</BODY>
<!-- InstanceEnd -->
</HTML>
