<?php $yii_path = Yii::app()->request->baseUrl; ?>

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

    <h4><em>
            <?php if ($_POST['adulto'] == "1") {
                echo "Tercer";
            } else {
                echo "Segundo";
            } ?>
            paso</em>, completa el registro</h4>

    <div class="errorMessage" id="formResult"></div>
    <div id="AjaxLoader" style="display: none"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/aplicacion/loading.gif"></img></div>

    <p class="note">
        Campos con <span class="required">*</span> son requeridos.
    </p>

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

    <ul id="res-ubicaciones"></ul>

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
        var mapa = L.map('mapa').setView([51.505, -0.09], 13);
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
            maxZoom: 18,
        }).addTo(mapa);
    </script>

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

    <?php echo CHtml::ajaxSubmitButton("Enviar fotografía",CHtml::normalizeUrl(array('fotos/formulario_fotos','render'=>true)),
        array(
            'dataType'=>'json',
            'type'=>'post',
            'success'=>'function(data) {
                         $("#AjaxLoader").hide();  
                        if(data.status=="success"){
                         window.location.replace("'.Yii::app()->request->baseUrl.'/index.php/fotos/index?msj=Tu fotografía se subió correctamente");
                 		
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
                           $("#mybtn").prop("disabled", true);
                      }'
        ),array('id'=>'mybtn','class'=>'class1 class2 btn btn-lg btn-success', 'onclick'=>"this.disabled=true;"));
    ?>

    <?php $this->endWidget(); ?>

    <script>
        porCoordenadas(23.79162789, -102.04376221);
        porNombre('roma');
    </script>
</div>