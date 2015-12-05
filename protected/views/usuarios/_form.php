<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'usuarios-form',
			'enableAjaxValidation'=>false,
)); ?>

	<p class="note">
		Campos con <span class="required">*</span> son requeridos.
	</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('class'=>'form-control')); ?>
		<?php //echo $form->error($model,'nombre'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'apellido'); ?>
		<?php echo $form->textField($model,'apellido',array('class' => 'form-control')); ?>
		<?php //echo $form->error($model,'apellido'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'telefonos'); ?>
		<?php echo $form->textField($model,'telefonos',array('class' => 'form-control')); ?>
		<?php //echo $form->error($model,'telefonos'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'estado'); ?>
		<?php echo $form->dropDownList($model, 'estado', Usuarios::estados(), array('prompt'=>'---Selecciona---','class' => 'form-control')); ?>
		<?php //echo $form->error($model,'estado'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'municipio'); ?>
		<?php echo $form->textField($model,'municipio',array('class' => 'form-control')); ?>
		<?php //echo $form->error($model,'municipio'); ?>
	</div>

	<?php if ($model->isNewRecord) { ?>
	<br> <b>Los siguientes campos no pueden ser modificados una vez creado el registro.</b>
	<div class="form-group">
		<?php echo $form->labelEx($model,'edad'); ?>
		<?php echo $form->textField($model,'edad',array('class' => 'form-control')); ?>
		<br>(Dependiendo tu edad es la categor&iacute;a en la que ingresas; menores de 18
		a&ntilde;os para categor&iacute;a <b>J&oacute;venes</b> y de 18 a&ntilde;os en adelante
		para categor&iacute;a <b>Adultos</b>)
		<?php //echo $form->error($model,'apellido'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'correo'); ?>
		<?php echo $form->textField($model,'correo',array('class' => 'form-control')); ?>
		<?php //echo $form->error($model,'correo'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'usuario'); ?>
		<?php echo $form->textField($model,'usuario',array('class' => 'form-control', 'autocomplete'=>'off')); ?>
		<?php //echo $form->error($model,'usuario'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'passwd'); ?>
		<?php echo $form->passwordField($model,'passwd',array('class' => 'form-control')); ?>
		<?php //echo $form->error($model,'passwd'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'confirma_passwd'); ?>
		<?php echo $form->passwordField($model,'confirma_passwd',array('class' => 'form-control')); ?>
		<?php //echo $form->error($model,'passwd'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'compromiso'); ?>
		Como es que tu aportas al cuidado de la naturaleza y ¿a qué te comprometes para seguir cuidandola?
		<?php echo $form->textArea($model,'compromiso',array('class' => 'form-control', 'rows'=>10,'cols'=>90)); ?>
		<?php //echo $form->error($model,'usuario'); ?>
	</div>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'difusion'); ?>
		<?php echo $form->dropDownList($model, 'difusion', Usuarios::difusiones(), array('prompt'=>'---Selecciona---','class' => 'form-control')); ?>
		<?php //echo $form->error($model,'estado'); ?>
	</div>
	
	<div id="terminos">
		<?php include('protected/views/site/terminos_y_condiciones.php'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'acepto_terminos'); ?>
		<?php echo $form->checkBox($model,'acepto_terminos'); ?>
	</div>

	<?php } else { //pone la confirmación del passwd ?>
	<br>Si no deseas cambiar tu contrase&ntilde;a por favor deja estos campos vac&iacute;os.
	<div class="form-group">
		<?php echo $form->labelEx($model,'passwd'); ?>
		<?php echo $form->passwordField($model,'passwd',array('class' => 'form-control','value'=>'')); ?>
		<?php //echo $form->error($model,'passwd'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'confirma_passwd'); ?>
		<?php echo $form->passwordField($model,'confirma_passwd',array('class' => 'form-control','value'=>'')); ?>
		<?php //echo $form->error($model,'passwd'); ?>
	</div>
	<?php } ?>

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear cuenta' : 'Guardar cambios', array('class' => 'btn btn-sm btn-success')); ?>
	</div>

	<?php $this->endWidget(); ?>

	<?php /*if (!$model->isNewRecord) { ?>
	<form
		action="<?php echo Yii::app()->getBaseUrl(false); ?>/index.php/usuarios/delete"
		method="POST">
		<?php echo CHtml::submitButton('Borra tu cuenta', array('confirm'=>'¿Estás seguro de querer eliminar tu cuenta?')); ?>
		<input type="hidden" name="id" value="<?php echo $model->id; ?>">
	</form>
	<?php }*/ ?>
</div>
<!-- form -->
