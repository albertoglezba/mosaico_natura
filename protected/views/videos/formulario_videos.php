<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'videos-form',
			'enableAjaxValidation'=>true,
			'action'=>$this->createUrl('videos/formulario_videos'),
			'enableClientValidation'=>true,
	)
); ?>

	<h4><em>Segundo paso</em>, completa el registro</h4>
	
	<div class="errorMessage" id="formResult"></div>
	<div id="AjaxLoader" style="display: none"><img src="<?php echo Yii::app()->request->baseUrl; ?>/imagenes/aplicacion/loading.gif"></img></div>
	
	<p class="note">
		Campos con <span class="required">*</span> son requeridos.
	</p>

	<div class="row">
		<?php echo $form->labelEx($model,'titulo'); ?>
		Puede ser algo ilustrativo como el nombre de la especie que viste, el lugar, etc.
		<?php echo $form->textField($model,'titulo',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'titulo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textArea($model,'descripcion',array('rows'=>10,'cols'=>90, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>
	
	<?php 
		echo $form->hiddenField($model,'nombre_original',array('value'=>$_POST["nombre_original"])); 
		echo $form->error($model,'nombre_original');
		
		echo $form->hiddenField($model,'nombre',array('value'=>$_POST["nombre"]));
		echo $form->error($model,'nombre');
		
		echo $form->hiddenField($model,'ruta',array('value'=>$_POST["ruta"]));
		echo $form->error($model,'ruta');
		
		echo $form->hiddenField($model,'size',array('value'=>$_POST["size"]));
		echo $form->error($model,'size');
		
		echo $form->hiddenField($model,'type',array('value'=>$_POST["type"]));
		echo $form->error($model,'type');
	?>
		
	<br>

	<?php echo CHtml::ajaxSubmitButton('Enviar video',CHtml::normalizeUrl(array('videos/formulario_videos','render'=>true)),
                 array(
                     'dataType'=>'json',
                     'type'=>'post',
                     'success'=>'function(data) {
                         $("#AjaxLoader").hide();  
                        if(data.status=="success"){
                         window.location.replace("'.Yii::app()->request->baseUrl.'/index.php/videos/index?msj=Tu video se subió correctamente");
                 		
                        }
                         else{
                        $.each(data, function(key, val) {
                        $("#videos-form #"+key+"_em_").text(val);                                                    
                        $("#videos-form #"+key+"_em_").show();
                        });
                        }       
                    }',                    
                     'beforeSend'=>'function(){                        
                           $("#AjaxLoader").show();
                      }'
                     ),array('id'=>'mybtn','class'=>'class1 class2')); 
	?>
                     
	<?php $this->endWidget(); ?>

</div>