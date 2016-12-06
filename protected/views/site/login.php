
					<span>
					<?php
						if (isset($_GET['situacion']))
							echo $_GET['situacion'];
					?>
					</span>

					<h3>Ingresa tus datos, si ya habías creado una cuenta en anteriores concursos puedes ingresar con esas credenciales</h3>

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
						</div>

						<p>¿No recuerdas tu contraseña? Sigue este <?php echo CHtml::link("enlace", Yii::app()->request->baseUrl."/index.php/site/recupera"); ?></p>
						<?php $this->endWidget(); ?>
					</div><!-- form -->
			