<?php
/* @var $this FotosController */
/* @var $data Fotos */
?>

<div class="view">
<p>
	<b><?php echo CHtml::encode($data->categoria->nombre); ?></b> 
	<br><?php echo CHtml::link('[modificar la ubicación, descripción o marca/modelo de tu cámara fotográfica]', array('fotos/update/'.$data->id), array('style'=>'color:#BD5D28')); ?>
	</p>
	<?php 
	if (empty($data->marca))
		echo "<b>Marca/modelo de tu cámara fotográfica:</b> <span style=\"color:red;\">SIN DATOS</span>";
	else
		echo "<b>Marca/modelo de tu cámara fotográfica:</b> ".$data->marca;
	?>
	<br>
	<?php 
	if (empty($data->estado))
		echo "<b>Estado:</b> <span style=\"color:red;\">SIN DATOS</span>";
	else
		echo "<b>Estado:</b> ".$data->estado;
	?>
	<br>
	<?php
	if (empty($data->municipio)) 
		echo "<b>Delegación / Municipio:</b> <span style=\"color:red;\">SIN DATOS</span>";
	else
		echo "<b>Delegación / Municipio:</b> ".$data->municipio; 
	?>
	<br>
	<?php 
	if (empty($data->descripcion))
		echo "<b>Descripción:</b> <span style=\"color:red;\">SIN DATOS</span>";
	else 
		echo "<b>Descripción:</b> ".$data->descripcion;
	?>
	<?php echo CHtml::image($data->ruta."/".$data->nombre, $data->nombre_original,
			array("title"=>$data->categoria->nombre, "width"=>"900px")) ?>
	<br />
</div>
