<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
?>

<h1 class="text-info">Informaci&oacute;n de tu cuenta</h1>
<h3><?php echo CHtml::link('Actualiza tus datos <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>.', Yii::app()->baseUrl."/index.php/usuarios/update/".$model->id); ?></h3>
<?php

$this->widget ( 'zii.widgets.CDetailView', array (
	'data' => $model,
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