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

	<p class="note">
		Campos con <span class="required">*</span> son requeridos.
	</p>

	<?php echo $form->errorSummary($model); ?>

	<?php if ($model->isNewRecord) { ?>
	<div class="row">
		<?php echo $form->labelEx($model,'categoria_id'); ?>
		<?php echo $model->categorias($form, $model); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fotografia'); ?>
		(Solo se permiten archivos "jpg" con un peso máximo de 10 MB ≃ 10485760 bytes)<span
			class="required">*</span><br>
		<?php echo CHtml::activeFileField($model,'fotografia'); ?>
	</div>
	<?php } else { ?>
	<p>
		<?php echo "<b>Categoria: </b>".$model->categoria->nombre; ?>
	</p>
	<?php echo CHtml::image($model->ruta."/".$model->nombre, $model->nombre_original,
			array("title"=>$model->categoria->nombre, "width"=>"300px")); ?>
	<?php } ?>
	<div class="row">
		<?php echo $form->labelEx($model,'estado'); ?>
		<?php echo $form->dropDownList($model, 'estado', Usuarios::estados(), array('prompt'=>'---Selecciona---')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'municipio'); ?>
		<?php echo $form->textField($model,'municipio',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textArea($model,'descripcion',array('rows'=>10,'cols'=>90)); ?>
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
		<?php if ($model->isNewRecord) 
			echo CHtml::submitButton('Subir',
					array('confirm' => '¿Estás seguro de querer subir esta fotografía? Recuerda que no se puede cambiar de fotografía una vez en el servidor'));
		else
			echo CHtml::submitButton('Actualizar');
		?>
	
	</div>

	<?php $this->endWidget(); ?>

</div>
<!-- form -->
