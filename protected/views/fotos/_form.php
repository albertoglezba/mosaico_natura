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
	<br><br>
	<div class="row">
		<?php echo $form->labelEx($model,'fotografia'); ?>
		<br> (Solo se permiten archivos "jpg" con un peso máximo de 10 MB)<span class="required">*</span><br>
		<?php echo CHtml::activeFileField($model,'fotografia'); ?>
	</div>

	<?php /*if(CCaptcha::checkRequirements()) { ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha', array('captchaAction' => 'site/captcha')); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint">Por favor pon las letras que se muestran a continuación.
		<br/>No hay distinci&oacute;n entre may&uacute;sculas y min&uacute;sculas.</div>
		<?php //echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php } */?>
	<br>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Subir' : 'Actualizar', 
				array('confirm' => '¿Estás seguro de querer subir esta fotografía? Recuerda que no se puede cambiar de fotografía una vez en el servidor')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->