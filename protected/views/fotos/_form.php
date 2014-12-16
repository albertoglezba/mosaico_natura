<?php
/* @var $this FotosController */
/* @var $model Fotos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'fotos-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
			'enctype' => 'multipart/form-data',
	),
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'categoria_id'); ?>
		<?php echo $model->categorias($form, $model); ?>
		<?php //echo $form->textField($model,'categoria_id'); ?>
		<?php //echo $form->error($model,'categoria_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'fotografia'); ?>
		<?php echo CHtml::activeFileField($model,'fotografia'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Subir' : 'Actualizar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->