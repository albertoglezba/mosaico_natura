<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
?>

<span style='color:#BD5D28'>
<?php 
if (isset($_GET['situacion']))
	echo $_GET['situacion'];  
?>
</span>

<h1>Ingresa tus datos</h1>

<p>Para subir tus fotograf&iacute;as es necesario
	<?php echo CHtml::link('registrarse.',array('/usuarios/create'), array('style'=>'color:#BD5D28'));?>
</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'class'=>'form-control'
	),
	//'htmlOptions'=>array('class'=>'form-control')
)); ?>

	<div class="form-group">
		<label>Usuario o correo</label>
		<?php echo $form->textField($model,'username', array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="form-group">
		<label>Contrase&ntilde;a</label>
		<?php echo $form->passwordField($model,'password', array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'password'); ?>
		
	</div>

	<div class="form-group rememberMe">
		<label for="LoginForm_rememberMe">Recordarme la próxima vez</label>
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>
	
	<!-- div>
		¿Has olvidado tu <a href="<?php //echo Yii::app()->baseUrl."/index.php/usuarios/reset_passwd"; ?>">contrase&ntilde;a</a>?
	</div-->

	<div class="buttons">
		<?php echo CHtml::submitButton('Entra', array('class'=>'form-control btn btn-primary')); ?>
		<?php //echo CHtml::resetButton('Limpia'); ?>
	</div>
	
<?php $this->endWidget(); ?>
</div><!-- form -->