<?php
/* @var $this FotosController */
/* @var $dataProvider CActiveDataProvider */
$usuario = Usuarios::model()->findByPk(Yii::app()->user->id_usuario);
$categoria = $usuario->edad > 17 ? 'profesional' : 'juvenil';
?>

<h1>Tus fotograf&iacute;as en la categoria <?php echo $categoria; ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
