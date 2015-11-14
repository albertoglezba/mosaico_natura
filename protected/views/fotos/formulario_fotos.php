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

	<?php if ($model->isNewRecord) { ?>
	<div class="row">
		<?php echo $form->labelEx($model,'categoria_id'); ?>
		<?php echo $model->categorias($form, $model); ?>
		<?php echo $form->error($model,'categoria_id'); ?>
	</div>

	<?php } else { ?>
	<p>
		<?php echo "<b>Categoria: </b>".$model->categoria->nombre; ?>
	</p>
	<?php echo CHtml::image($model->ruta."/".$model->nombre, $model->nombre_original,
			array("title"=>$model->categoria->nombre, "width"=>"300px")); ?>
	<?php } ?>
	
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