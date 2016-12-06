<script type="text/javascript">

function validatePasswd(passwd) 
{
    if(passwd != "" && strlen(passwd) > 3)
        return true;
    return false;
}

	$(document).ready(function(){
		$('#boton').on('click', function(){
			if(!validatePasswd($('#passwd').val()))
				$('#error').html('').html('La contraseña no debe ser vacia o menor a 4 caracteres.');
			return false;
		});
	});	

</script>

Estiamdo <?php echo $usuario->nombre." ".$usuario->apellido.", "; ?>
<br>
por favor escribe una nueva contrase&ntilde;a
<br><br>
<form method="get" action="<?php echo Yii::app()->request->baseUrl.'/index.php?r=site/nueva_contrasenia'; ?>">
Contrase&ntilde;a: <input name="passwd" id="passwd" type="text"> <span style="color: red;" id="error"></span>
<br>
	<input type="hidden" name="r" value="site/nueva_contrasenia">
	<div class="buttons" align="right">
		<input type="submit" value="Cambiar" id="boton">
	</div >
	<input name="id" type="hidden" value="<?php echo $usuario->id; ?>">
	<input name="fec_alta" type="hidden" value="<?php echo $usuario->fec_alta; ?>">
</form>