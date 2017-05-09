<script type="text/javascript">
	function validateEmail(email) 
	{
	    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	    return re.test(email);
	}

	$(document).ready(function(){
		$('#boton').on('click', function(){

			if(!validateEmail($('#correo').val()) || $('#correo').val() == '')
			{
				$('#msj').css("color", "red").html('El correo no es correcto. Por favor verificalo.');
				return false;	
			}

			jQuery.ajax({
				method: 'POST',
		        url: $('#forma_recupera').attr('action'),
		        data: $('#forma_recupera').serialize(),
				success: function(res){
					if (res.estatus == "1") $('#msj').css("color", "green").html(res.msj);
					else $('#msj').css("color", "red").html(res.msj);
		        	
		        },
		        fail: function(){
		            $('#msj').css("color", "red").html('Hubo un error al enviar el correo, por favor inténtalo de nuevo.');
		        }
		    });

		    return false;
		});
	});

</script>

<h4>Para recuperar tu cuenta por favor escribe el correo que registraste
	y dale enviar. En unos minutos te ser&aacute; enviado un correo con el
	cual podr&aacute;s poner una nueva contrase&ntilde;a</h4>

<br>
NOTA: Asegurate de revisar tu bandeja de correo no deseado o spam
<p>
<form action="<?php echo Yii::app()->request->baseUrl.'/index.php/site/envia_correo'; ?>" id="forma_recupera">

	<div class="row">
		Correo: 
		<input id="correo" name="correo" type="email" class="form-control"> 
		<span id="msj"></span> <br> 
		
		<div align="right">
			<input type="submit" value="Enviar" id="boton" class="class1 class2 btn btn-success">
		</div>
	</div>

</form>
</p>