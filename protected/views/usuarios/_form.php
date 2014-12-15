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

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>255)); ?>
		<?php //echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'apellido'); ?>
		<?php echo $form->textField($model,'apellido',array('size'=>60,'maxlength'=>255)); ?>
		<?php //echo $form->error($model,'apellido'); ?>
	</div>

	<?php if ($model->isNewRecord) { ?>
	<div class="row">
		<?php echo $form->labelEx($model,'correo'); ?>
		<?php echo $form->textField($model,'correo',array('size'=>60,'maxlength'=>255)); ?>
		<?php //echo $form->error($model,'correo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'usuario'); ?>
		<?php echo $form->textField($model,'usuario',array('size'=>60,'maxlength'=>255, 'autocomplete'=>'off')); ?>
		<?php //echo $form->error($model,'usuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'passwd'); ?>
		<?php echo $form->passwordField($model,'passwd',array('size'=>60,'maxlength'=>255)); ?>
		<?php //echo $form->error($model,'passwd'); ?>
	</div>
	<?php } ?>

	<div class="row">
		<?php echo $form->labelEx($model,'telefonos'); ?>
		<?php echo $form->textField($model,'telefonos',array('size'=>60,'maxlength'=>255)); ?>
		<?php //echo $form->error($model,'telefonos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'calle_y_numero'); ?>
		<?php echo $form->textField($model,'calle_y_numero',array('size'=>60,'maxlength'=>255)); ?>
		<?php //echo $form->error($model,'calle_y_numero'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'colonia'); ?>
		<?php echo $form->textField($model,'colonia',array('size'=>60,'maxlength'=>255)); ?>
		<?php //echo $form->error($model,'colonia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'municipio'); ?>
		<?php echo $form->textField($model,'municipio',array('size'=>60,'maxlength'=>255)); ?>
		<?php //echo $form->error($model,'municipio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'estado'); ?>
		<?php echo $form->dropDownList($model, 'estado', Usuarios::estados(), array('prompt'=>'---Selecciona---')); ?>
		<?php //echo $form->error($model,'estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cp'); ?>
		<?php echo $form->textField($model,'cp',array('size'=>5,'maxlength'=>5)); ?>
		<?php //echo $form->error($model,'cp'); ?>
	</div>

	<?php if ($model->isNewRecord) { ?>
	<div class="row">
		<iframe id="tcIframe" width="100%" height="550"
			src="<?php echo Yii::app()->getBaseUrl(false); ?>/index.php/site/terminos_y_condiciones"></iframe>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'acepto_terminos'); ?>
		<?php echo $form->checkBox($model,'acepto_terminos'); ?>
	</div>
	<?php } ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear cuenta' : 'Guardar cambios'); ?>
	</div>

	<?php $this->endWidget(); ?>
	
	<?php if (!$model->isNewRecord) { ?>
	<form
		action="<?php echo Yii::app()->getBaseUrl(false); ?>/index.php/usuarios/delete" method="POST">
		<?php echo CHtml::submitButton('Borra tu cuenta', array('confirm'=>'¿Estás seguro de querer eliminar tu cuenta?')); ?>
		<input type="hidden" name="id" value="<?php echo $model->id; ?>">
	</form>
	<?php } ?>
</div>
<!-- form -->
