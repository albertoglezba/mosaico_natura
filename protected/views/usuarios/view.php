<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
?>

<h1>Informaci&oacute;n de tu cuenta</h1>
<?php echo CHtml::link('Configura', Yii::app()->baseUrl."/index.php/usuarios/update/".$model->id); ?> tu cuenta.
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