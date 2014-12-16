<?php
/* @var $this FotosController */
/* @var $dataProvider CActiveDataProvider */
?>

<h1>Tus fotograf&iacute;as</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
