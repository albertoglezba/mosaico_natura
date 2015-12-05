<?php $yii_path = Yii::app()->request->baseUrl; ?>

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
					} else
						echo CHtml::link('Inicia sesión', array('site/login'));
					echo " | ".CHtml::link('Preguntas frecuentes', 'http://www.mosaiconatura.net/#preguntas');
					?>
				</p>
				<script type="text/javascript">
					$(document).ready(function(){
						$('#Fotos_categoria_id').on('change', function(){

							$.ajax({
								method: "POST",
								url: "<?php echo Yii::app()->request->baseUrl; ?>" + "/index.php/fotos/aws",
								data: {categoria: $(this).val(), adulto: "<?php echo $adulto; ?>"}
							}).done(function( html ) {
								$('#Fotos_categoria_id').attr('disabled', 'disabled');
								$('#formulario_completo').append(html);
							});
						});
					});
				</script>


				<h4><em>Primer paso</em>, elige una categoría</h4>
				<p class="text-warning">
					(Recuerda que solo puedes subir una fotografía por categor&iacute;a, una vez procesada
					no se permiten hacer cambios)
				</p>

				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'categoria-form',
					'enableAjaxValidation'=>false )); ?>

				<div class="form">

					<?php $model=new Fotos; ?>
					<div class="form-group">
						<?php echo CHtml::label('Categoria','categoria_id'); ?>
						<?php echo $model->categorias($form, $model); ?>
						<?php echo $form->error($model,'categoria_id'); ?>
					</div>

				</div>

				<?php $this->endWidget(); ?>


				<div id='formulario_completo'></div>


			</div>
		</div>
	</div>

</section>


