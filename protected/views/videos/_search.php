<?php
/* @var $this FotosController */
/* @var $model Fotos */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre_original'); ?>
		<?php echo $form->textField($model,'nombre_original',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'size'); ?>
		<?php echo $form->textField($model,'size',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fec_alta'); ?>
		<?php echo $form->textField($model,'fec_alta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fec_act'); ?>
		<?php echo $form->textField($model,'fec_act'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'usuario_id'); ?>
		<?php echo $form->textField($model,'usuario_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'categoria_id'); ?>
		<?php echo $form->textField($model,'categoria_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->