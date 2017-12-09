<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
/*
$this->breadcrumbs=array(
	'Error',
);*/
?>

<h2>Ha habido un error <?php echo $code; ?></h2>

<h3 class="error text-danger">
<?php echo CHtml::encode($message); ?>
</h3>