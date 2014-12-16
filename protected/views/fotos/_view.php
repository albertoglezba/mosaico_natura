<?php
/* @var $this FotosController */
/* @var $data Fotos */
?>

<div class="view">
	<b><?php echo CHtml::encode($data->categoria->nombre); ?></b>
	<br>
	<?php echo CHtml::image($data->ruta."/".$data->nombre, $data->nombre_original,
			array("title"=>$data->categoria->nombre, "width"=>"900px")) ?>
	<br />
</div>
