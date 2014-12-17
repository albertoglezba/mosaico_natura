<?php
/* @var $this FotosController */
/* @var $model Fotos */
?>

<h1>Sube una fotografía</h1>
(Recuerda que solo puedes subir una por categor&iacute;a, una vez procesada la 
 fotografía no se permiten hacer cambios)

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>