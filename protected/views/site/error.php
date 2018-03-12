<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
/*
$this->breadcrumbs=array(
	'Error',
);*/
?>

<?php if(isset($code)){ ?>
	<h4>Ha habido un error <?php echo $code; ?></h4>
<?php }?>

<h2 class="error text-danger"><?php echo CHtml::encode($message); ?></h2>
