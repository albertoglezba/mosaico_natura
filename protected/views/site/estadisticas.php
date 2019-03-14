<dl class="dl-horizontal">
	<h2>Estadísticas 5to concurso Mosaico Natura</h2>
	<hr />
	<?php
		foreach($stats as &$stat){
			?>
			
			<?php
			if($stat['conteo'] == 0){
				echo('<hr />');
				echo('<h4>'.$stat['titulo'].'</h4>');
			}else{
				echo('<dt>'.$stat['conteo'].'</dt>');
				echo('<dd> => '.$stat['titulo'].'</dd>');
			}
		}
	?>
</dl>
