<?php
/* @var $this FotosController */
/* @var $model Fotos */
?>

<h1><em>Primer paso</em>, elige subir una fotografía o un video</h1>
(Recuerda que solo puedes subir una por categor&iacute;a, una vez procesado el material 
 multimedia no se permiten hacer cambios)


<?php echo $this->renderPartial('_aws', array('model'=>$model)); ?>