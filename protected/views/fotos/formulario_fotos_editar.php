<?php $yii_path = Yii::app()->request->baseUrl; ?>

<script type="text/javascript" src="<?php echo $yii_path; ?>/js/locationpicker.jquery.js"></script>

<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'fotos-form',
			'enableAjaxValidation'=>true,
			'action'=>$this->createUrl('fotos/formulario_fotos_editar', array('id' => $model->id)),
			'enableClientValidation'=>true
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php if (!empty($model->categoria_id)) { ?>
		<p>
			<?php echo "<b>Categoria: </b>".$model->categoria->nombre; ?>
		</p>
	<?php } ?>
	
	<?php echo CHtml::image($model->ruta, $model->nombre_original,
			array("title"=>$model->titulo, "width"=>"300px")); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'titulo'); ?>
		Puede ser algo ilustrativo como el nombre de la especie que viste, el lugar, etc.
		<?php echo $form->textField($model,'titulo',array('rows'=>10,'cols'=>90, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'titulo'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'direccion'); ?>
		Puedes autocompletar el lugar en el cual tomaste tu fotografía, arrastrar el marcador del mapa o escribir las coordenadas. 
		<?php echo $form->textField($model,'direccion',array('size'=>60,'maxlength'=>500, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'direccion'); ?>
	</div>
	
	<div id="mapa" style="width: 500px; height: 400px;"></div>				
	
	<div class="row">
		<?php echo $form->labelEx($model,'latitud'); ?>
		<?php echo $form->textField($model,'latitud',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'latitud'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'longitud'); ?>
		<?php echo $form->textField($model,'longitud',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'longitud'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'marca'); ?>
		<?php echo $form->textField($model,'marca',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'marca'); ?>
	</div>
	
	<script>
	
	$('#mapa').locationpicker({
		location: {latitude: "<?php echo $model->latitud; ?>", longitude: "<?php echo $model->longitud; ?>"},
		radius: 3,
		inputBinding: {
	        latitudeInput: $('#Fotos_latitud'),
    	    longitudeInput: $('#Fotos_longitud'),
        	locationNameInput: $('#Fotos_direccion')
    	},
    	enableAutocomplete: true,
    	zoom: 4
	});

	</script>
		
	<br>

	<?php echo CHtml::ajaxSubmitButton('Actualizar fotografía',CHtml::normalizeUrl(array("fotos/formulario_fotos_editar/",'render'=>true, 'id'=>$model->id)),
                 array(
                     'dataType'=>'json',
                     'type'=>'post',
                     'success'=>'function(data) {
                         $("#AjaxLoader").hide();  
                        if(data.status=="success"){
                         window.location.replace("'.Yii::app()->request->baseUrl.'/index.php/fotos/index?msj=Tu fotografía se actualizó correctamente");
                 		
                        }
                         else{
                        $.each(data, function(key, val) {
                        $("#fotos-form #"+key+"_em_").text(val);                                                    
                        $("#fotos-form #"+key+"_em_").show();
                        });
                        }       
                    }',                    
                     'beforeSend'=>'function(){                        
                           $("#AjaxLoader").show();
                      }'
                     ),array('id'=>'mybtn','class'=>'class1 class2 btn btn-success')); 
	?>
                     
	<?php $this->endWidget(); ?>

</div>