<div class="view">
	<h4>Haz subido un video llamado "<?php echo $data->nombre_original ?>" con la siguiente información:</h4>
	<?php
	if (empty($data->titulo)) 
		echo "<b>Título:</b> <span style=\"color:red;\">SIN DATOS</span>";
	else
		echo "<strong>".$data->titulo."</strong>"; 
	?>
	<br>
	<?php 
	if (empty($data->descripcion))
		echo "<b>Descripción:</b> <span style=\"color:red;\">SIN DATOS</span>";
	else 
		echo "<b>Descripción:</b> ".$data->descripcion;
	?>
</div>
