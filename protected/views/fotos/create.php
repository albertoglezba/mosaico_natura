<?php
/* @var $this FotosController */
/* @var $model Fotos */
?>

<h1>Sube una fotografía</h1>
(Recuerda que solo puedes subir una por categoria)

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>