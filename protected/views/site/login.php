<section id="registro" class="content-section text-center">
	<div class="registro-header">
		<div class="container">
			<div class="col-lg-8 col-lg-offset-2">
				<h2>REGISTRO</h2>
			</div>
		</div>
	</div>

	<div class="registro-content">
		<div class="container">
			<div class="col-md-12">
				<p>
					<?php
					if (!Yii::app()->user->isGuest)
					{
						if (!isset(Yii::app()->user->id_usuario) || empty(Yii::app()->user->id_usuario))
						{
							if (!isset(Yii::app()->user->id) || empty(Yii::app()->user->id))
							{
								Yii::app()->user->logout();
								echo CHtml::link('Inicia sesión', array('site/login'));
							} else {
								$this->setIdUsuario(Yii::app()->user->id);
								$usuario = Usuarios::model()->findByPk(Yii::app()->user->id_usuario);
								echo CHtml::link('Tus fotografías', array('fotos/index'));
								echo " | ".CHtml::link('Propiedades de tu cuenta', array('usuarios/'.$usuario->id));
								echo " | ".CHtml::link('Cerrar sesión('.Yii::app()->user->name.')', array('site/logout'));
							}
						} else {
							$usuario = Usuarios::model()->findByPk(Yii::app()->user->id_usuario);
							echo CHtml::link('Tus fotografías', array('fotos/index'));
							echo " | ".CHtml::link('Propiedades de tu cuenta', array('usuarios/'.$usuario->id));
							echo " | ".CHtml::link('Cerrar sesión('.Yii::app()->user->name.')', array('site/logout'));
						}
					} else{?>
					<span>
					<?php
						if (isset($_GET['situacion']))
							echo $_GET['situacion'];
					?>
					</span>

					<h1>Ingresa tus datos</h1>

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
					<?php }?>
				</p>




			</div>
		</div>
	</div>

</section>
