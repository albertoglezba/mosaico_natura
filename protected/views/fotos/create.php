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

<h4><em>Primer paso</em>, una categoría</h4>
<p class="text-warning">
	(Recuerda que solo puedes subir una fotografía por categor&iacute;a, una vez procesada
	no se permiten hacer cambios)
</p>

<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'categoria-form',
			'enableAjaxValidation'=>false )); ?>

<div class="form">

<?php $model=new Fotos; ?>
	<div class="form-group">
		<?php echo CHtml::label('Categoria','categoria_id'); ?>
		<?php echo $model->categorias($form, $model); ?>
		<?php echo $form->error($model,'categoria_id'); ?>
	</div>

</div>

<?php $this->endWidget(); ?>


<div id='formulario_completo'></div>