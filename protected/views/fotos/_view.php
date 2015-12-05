<?php
/* @var $this FotosController */
/* @var $data Fotos */
?>

<div class="view">
	
	<h2><?php echo CHtml::encode($data->categoria->nombre) ?></h2>
	<h3><strong><em><?php echo $data->titulo; ?></em></strong></h3>
	<div>
	<?php echo CHtml::image($data->ruta, '', array("title"=>$data->titulo, "width"=>"900px")) ?>
	</div>	
	
	<?php echo "<h5>Ubicación:".$data->direccion." (".$data->latitud.",".$data->longitud.")</h5>";?>
	<?php 
	if (empty($data->marca)){
		echo "<h5><b>Marca/modelo de tu cámara fotográfica:</b> <span style=\"color:red;\">SIN DATOS</span></h5>";
	}else{
		echo "<h5><b>Marca/modelo de tu cámara fotográfica:</b> ".$data->marca."</h5>";
	}
	?>
</div>
