<?php
/* @var $this FotosController */
/* @var $dataProvider CActiveDataProvider */
$usuario = Usuarios::model()->findByPk(Yii::app()->user->id_usuario);
$categoria = Usuarios::dameEdad($usuario->fecha_nac) > 17 ? 'Adultos' : 'Jóvenes';
?>

<?php
if (isset($_GET['msj']) && !empty($_GET['msj']))
{
	echo $_GET['msj'];
}
?>

<h1>Tus fotograf&iacute;as en la categor&iacute;a "<?php echo $categoria; ?>"</h1>
<h4 class="text-warning"><i><b>NOTA:</b> Recuerda que es importante que tus fotografías tengan una ubicación y descripción</i></h4>
<?php echo CHtml::link('<span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Subir fotografías', Yii::app()->baseUrl."/index.php/fotos/create", array('class'=>"btn btn-lg btn-info")); ?>
<hr />
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
