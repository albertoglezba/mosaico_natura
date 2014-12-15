<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
?>

<h1>Informaci&oacute;n de tu cuenta</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'usuario',
		'nombre',
		'apellido',
		'correo',
		'telefonos',
		'calle_y_numero',
		'colonia',
		'municipio',
		'estado',
		'cp',
		'fec_alta',
	),
)); ?>