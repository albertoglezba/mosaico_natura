<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'usuarios-form',
			'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>255)); ?>
		<?php //echo $form->error($model,'nombre'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>
