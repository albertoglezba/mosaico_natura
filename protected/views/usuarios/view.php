<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
?>

<h1>Informaci&oacute;n de tu cuenta</h1>
<h4>Configurar tus datos: <?php echo CHtml::link('<span class="btn btn-link glyphicon glyphicon-cog" aria-hidden="true"></span>', Yii::app()->baseUrl."/index.php/usuarios/update/".$model->id); ?></h4>
<?php

$this->widget ( 'zii.widgets.CDetailView', array (
	'data' => $model,
	'htmlOptions'=>array(
		'class'=>'table-responsive table-condensed',
	),
	'attributes' => array (
		'usuario',
		'nombre',
		'apellido',
		'correo',
		'telefonos',
		'municipio',
		'estado',
		'compromiso',
		'difusion',
		'fec_alta'
	)

) );
?>
<script>
	$("#yw0").removeClass("detail-view");
	$("#yw0").addClass("table");
</script>