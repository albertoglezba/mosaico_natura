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
				$('#error').html('La contraseña no debe ser vacia o menor a 4 caracteres.');

			jQuery.ajax({
				method: 'POST',
		        url: $('#forma_recupera').attr('action'),
		        data: $('#forma_recupera').serialize(),
				success: function(res){
					if (res.estatus == "1") $('#msj').css("color", "green").html(res.msj);
					else $('#msj').css("color", "red").html(res.msj);
		        	
		        },
		        fail: function(){
		            $('#msj').css("color", "red").html('Hubo un error al enviar el correo, por favor intentalo de nuevo.');
		        }
		    });

		    return false;
		});
	});	

</script>

Estiamdo <?php echo $usuario->nombre." ".$usuario->apellido.", "; ?>
<br>
por favor escribe una nueva contrase&ntilde;a
<br><br>
<form method="get" action="<?php echo Yii::app()->request->baseUrl.'/index.php?r=site/nueva_contrasenia'; ?>">
Contrase&ntilde;a: <input name="passwd" id="passwd" type="password" class="form-control"> <span style="color: red;" id="error"></span>
<br>
	<div class="buttons" align="right">
		<input type="submit" value="Cambiar" id="boton" class="class1 class2 btn btn-success">
	</div >
	<input name="id" type="hidden" value="<?php echo $usuario->id; ?>">
	<input name="fec_alta" type="hidden" value="<?php echo $usuario->fec_alta; ?>">
</form>