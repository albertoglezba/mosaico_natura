<?php
/* @var $this FotosController */
/* @var $dataProvider CActiveDataProvider */
$usuario = Usuarios::model()->findByPk(Yii::app()->user->id_usuario);
$categoria = $usuario->edad > 17 ? 'Adultos' : 'Jóvenes';
?>

<?php 
	if (isset($_GET['msj']) && !empty($_GET['msj'])) 
	{
		echo $_GET['msj'];
	} 
?>


<section id="registro" class="content-section text-center">
	<div class="registro-header">
		<div class="container">
			<div class="col-lg-8 col-lg-offset-2">
				<h2>Tus Fotos</h2>
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


				<?php }?>
				</p>
				<h1>Tus fotograf&iacute;as en la categor&iacute;a "<?php echo $categoria; ?>"</h1>
				<i><b>NOTA:</b> Recuerda que es importante que tus fotografías tengan una ubicación y descripción</i><br><br>
				<?php echo CHtml::link('Subir', Yii::app()->baseUrl."/index.php/fotos/create", array('style'=>"color:#BD5D28;")); ?> m&aacute;s fotograf&iacute;as

				<?php $this->widget('zii.widgets.CListView', array(
					'dataProvider'=>$dataProvider,
					'itemView'=>'_view',
				)); ?>



			</div>
		</div>
	</div>

</section>













