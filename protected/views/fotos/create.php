<script type="text/javascript">
$(document).ready(function(){
	$('#Fotos_categoria_id').on('change', function(){

		$.ajax({
      	  method: "POST",
      	  url: "<?php echo Yii::app()->request->baseUrl; ?>" + "/index.php/fotos/aws",
      	  data: {categoria: $(this).val(), adulto: "<?php echo $adulto; ?>"}
      	}).done(function( html ) {
          	$('#Fotos_categoria_id').attr('disabled', 'disabled');
          	$('#formulario_completo').append(html);
      	  });
	});	
});	
</script>


Location: <input type="text" id="us2-address" style="width: 200px"/>
<div id="us2" style="width: 500px; height: 400px;"></div>				
Lat.: <input type="text" id="us2-lat"/>
Long.: <input type="text" id="us2-lon"/>
<script>$('#us2').locationpicker({
	location: {latitude: 46.15242437752303, longitude: 2.7470703125},	
	radius: 3,
	inputBinding: {
        latitudeInput: $('#us2-lat'),
        longitudeInput: $('#us2-lon'),
        locationNameInput: $('#us2-address')
    },enableAutocomplete: true
	});
</script>

<h1><em>Primer paso</em>, elige subir una fotografía o un video</h1>
(Recuerda que solo puedes subir una por categor&iacute;a, una vez procesado el material 
 multimedia no se permiten hacer cambios)

<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'categoria-form',
			'enableAjaxValidation'=>false )); ?>

<div class="form">

<?php $model=new Fotos; ?>
	<div class="row">
		<?php echo CHtml::label('Categoria','categoria_id'); ?>
		<?php echo $model->categorias($form, $model); ?>
		<?php echo $form->error($model,'categoria_id'); ?>
	</div>

</div>

<?php $this->endWidget(); ?>


<div id='formulario_completo'></div>