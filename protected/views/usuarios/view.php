<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
?>

<h1>Informaci&oacute;n de tu cuenta</h1>
<?php echo CHtml::link('<span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Configurar tus datos', Yii::app()->baseUrl."/index.php/usuarios/update/".$model->id, array('class'=>"btn btn-lg btn-info")); ?>
<hr />
<?php

$this->widget ( 'zii.widgets.CDetailView', array (
	'data' => $model,
	'htmlOptions'=>array(
		'class'=>'table-responsive table-bordered text-left',
	),
	'attributes' => array (
		'usuario',
		'nombre',
		'apellido',
		'fecha_nac',
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