<?php
/* @var $this FotosController */
/* @var $data Fotos */
?>

<div class="view">
	<?php 
	if (empty($data->titulo))
		echo "<span style=\"color:red;\">SIN DATOS</span>";
	else 
		echo "<strong>".$data->titulo."</strong>";
	?>
	
	<p>
	<b><?php echo "<b>".CHtml::encode($data->categoria->nombre) ?></b> 
	</p>
	
	<br>
	<?php 
	if (empty($data->direccion))
		echo "<b>Ubicación:</b> <span style=\"color:red;\">SIN DATOS</span>";
	else
		echo "<b>Ubicación:</b> ".$data->direccion." (".$data->latitud.",".$data->longitud.")";
	?>
	<br>
	<?php 
	if (empty($data->marca))
		echo "<b>Marca/modelo de tu cámara fotográfica:</b> <span style=\"color:red;\">SIN DATOS</span>";
	else
		echo "<b>Marca/modelo de tu cámara fotográfica:</b> ".$data->marca;
	?>
	<br>
	<?php echo CHtml::image($data->ruta, '',
			array("title"=>$data->titulo, "width"=>"900px")) ?>
	<br />
</div>
