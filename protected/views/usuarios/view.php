<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
?>
<div class="row">
	<div class="col-sm-12">
		<h1>Informaci&oacute;n de tu cuenta</h1>

		<?php if(isset($notice)){ ?>
			<h4 class="alert alert-info"><?php echo $notice ?></h4>
		<?php } ?>

		<hr />
		<?php echo CHtml::link('<span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Edita tus datos', Yii::app()->baseUrl."/index.php/usuarios/update/".$model->id, array('class'=>"btn btn-lg btn-info")); ?>
	</div>

	<div class="col-sm-12">
		<?php

		$this->widget ( 'zii.widgets.CDetailView', array (
			'data' => $model,
			'htmlOptions'=>array(
				'class'=>'table-responsive text-right text-primary',
				'style'=>'margin: 20px auto; font-size: 2em; width: auto;'
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

	</div>
</div>

<script>
	$("#yw0").removeClass("detail-view");
	$("#yw0").addClass("table");
</script>