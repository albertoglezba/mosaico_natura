<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'fotos-form',
			'enableAjaxValidation'=>true,
			'action'=>$this->createUrl('fotos/formulario_fotos'),
			'enableClientValidation'=>true,
			'htmlOptions' => array(
			'enctype' => 'multipart/form-data',
	),
)); ?>

	<div class="errorMessage" id="formResult"></div>
	<div id="AjaxLoader" style="display: none"><img src="<?php echo Yii::app()->request->baseUrl; ?>/imagenes/aplicacion/loading.gif"></img></div>
	
	<p class="note">
		Campos con <span class="required">*</span> son requeridos.
	</p>
	
	<div class="row">
		<?php echo $form->labelEx($model,'marca'); ?>
		<?php echo $form->textField($model,'marca',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'marca'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'estado'); ?>
		<?php echo $form->dropDownList($model, 'estado', Usuarios::estados(), array('prompt'=>'---Selecciona---')); ?>
		<?php echo $form->error($model,'estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'municipio'); ?>
		<?php echo $form->textField($model,'municipio',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'municipio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textArea($model,'descripcion',array('rows'=>10,'cols'=>90)); ?>
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
		
		echo $form->hiddenField($model,'categoria_id',array('value'=>$_POST["categoria_id"]));
		echo $form->error($model,'categoria_id');
	?>
		
	<br>

	<?php echo CHtml::ajaxSubmitButton('Enviar',CHtml::normalizeUrl(array('fotos/formulario_fotos','render'=>true)),
                 array(
                     'dataType'=>'json',
                     'type'=>'post',
                     'success'=>'function(data) {
                         $("#AjaxLoader").hide();  
                        if(data.status=="success"){
                         $("#formResult").html("form submitted successfully.");
                         //$("#user-form")[0].reset();
                 		
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
                     ),array('id'=>'mybtn','class'=>'class1 class2')); 
	?>
                     
	<?php $this->endWidget(); ?>

</div>