<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
?>

<h1>Informaci&oacute;n de tu cuenta</h1>
<?php echo CHtml::link('Configura', Yii::app()->baseUrl."/index.php/usuarios/update/".$model->id, array('style'=>"color:#BD5D28;")); ?> tu cuenta.
<br><br><?php $this->widget('zii.widgets.CDetailView', array(
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