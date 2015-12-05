<h1>Tu video</h1>
<?php echo CHtml::link('Subir', Yii::app()->baseUrl."/index.php/videos/create", array('style'=>"color:#BD5D28;")); ?> un video
<br><br>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
