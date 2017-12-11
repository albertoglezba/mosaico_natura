<h1>Tus videos</h1>
<?php echo CHtml::link('<span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Subir videos', Yii::app()->baseUrl."/index.php/videos/create", array('class'=>"btn btn-lg btn-info")); ?>
<hr />
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
