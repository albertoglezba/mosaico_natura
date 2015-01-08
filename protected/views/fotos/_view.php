<?php
/* @var $this FotosController */
/* @var $data Fotos */
?>

<div class="view">
<p>
	<b><?php echo CHtml::encode($data->categoria->nombre); ?></b> 
	<br><?php echo CHtml::link('[modificar la ubicación o descripción]', array('fotos/update/'.$data->id), array('style'=>'color:#BD5D28')); ?>
	</p>
	<?php 
	if (empty($data->estado))
		echo "<b>Estado:</b> SIN DATOS";
	else
		echo "<b>Estado:</b> ".$data->estado;
	?>
	<br>
	<?php
	if (empty($data->municipio)) 
		echo "<b>Delegación / Municipio:</b> SIN DATOS";
	else
		echo "<b>Delegación / Municipio:</b> ".$data->municipio; 
	?>
	<br>
	<?php 
	if (empty($data->descripcion))
		echo "<b>Descripción:</b> SIN DATOS";
	else 
		echo "<b>Descripción:</b> ".$data->descripcion;
	?>
	<?php echo CHtml::image($data->ruta."/".$data->nombre, $data->nombre_original,
			array("title"=>$data->categoria->nombre, "width"=>"900px")) ?>
	<br />
</div>
