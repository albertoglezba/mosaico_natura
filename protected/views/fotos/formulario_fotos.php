<?php $yii_path = Yii::app()->request->baseUrl; ?>

<h3 class="text-left text-success"><b><?php echo (($_POST['adulto'] == "1") ? "Tercer" : "Segundo") ?> paso:</b> completa el registro <br />
	<small class="text-left text-warning">Campos con <b class="required">*</b> son requeridos.</small>
</h3>

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
<div id="AjaxLoader" style="display: none"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/aplicacion/loading.gif"></img></div>

<div class="form-group text-left">
	<?php echo $form->labelEx($model,'titulo', array('class'=>'col-sm-2 control-label text-right')); ?>
	<div class="col-sm-6">
		<?php echo $form->textField($model,'titulo',array('class'=>'form-control')); ?>
		<h4><small>Puede ser algo ilustrativo como el nombre de la especie que viste, el lugar, etc.</small></h4>
		<?php echo $form->error($model,'titulo'); ?>
	</div>
	<div class="clearfix"></div>
	<?php echo $form->labelEx($model,'direccion', array('class'=>'col-sm-2 control-label text-right')); ?>
	<div class="col-sm-4">
		<div class="input-group">
			<?php echo $form->textField($model,'direccion',array('maxlength'=>500, 'class'=>'form-control')); ?>
			<div class="input-group-addon"><a href="#" id="boton-ubicaciones"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></div>
		</div>
		<ul id="res-ubicaciones"></ul>
		<?php echo $form->error($model,'direccion'); ?>
	</div>

	<?php echo $form->labelEx($model,'latitud', array('class'=>'col-sm-1 control-label text-right')); ?>
	<div class="col-sm-2">
		<?php echo $form->textField($model,'latitud',array('maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'latitud'); ?>
	</div>
	
	<?php echo $form->labelEx($model,'longitud', array('class'=>'col-sm-1 control-label text-right')); ?>
	<div class="col-sm-2">
		<?php echo $form->textField($model,'longitud',array('maxlength'=>255, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'longitud'); ?>
	</div>
	<h4 class="text-center"><small>Puedes buscar el lugar en donde se tomó la fotografía, escribir las coordenadas (latitud y longitud), o dar click en el mapa.</small></h4>
	<div class="clearfix"></div>
</div>

<div id="mapa"></div>

<div class="clearfix"></div>
<div class="form-group text-left">
	<?php echo $form->labelEx($model,'marca', array('class'=>'col-sm-5 control-label text-right')); ?>
			<div class="col-sm-5">
				<?php echo $form->textField($model,'marca',array('maxlength'=>255, 'class'=>'form-control')); ?>
				<?php echo $form->error($model,'marca'); ?>
			</div>
</div>

<script>
	map = L.map('mapa').setView([24.21179847133122, -101.9306640625], 5);
	L.tileLayer('https://maps.tilehosting.com/styles/topo/{z}/{x}/{y}.png?key=zlRxsCdX8uurAv6boyCD', {attribution: '<a href="https://www.maptiler' +
			'.com/copyright/">MapTiler</a> &copy; <a href="https://www.openstreetmap.org/copyright" target="_blank"> OpenStreetMap</a> &copy; contributors'}).addTo(map);
	var c = new L.Control.Coordinates();
	c.addTo(map);
	
	ubicacion = L.marker([0, 0]);
	ubicacion.addTo(map);
	
	map.on('click', function(e) {
		c.setCoordinates(e);
		porCoordenadas(e.latlng.lat, e.latlng.lng);
		ubicacion.setLatLng(e.latlng);
	});
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

<div class="clearfix"></div>

<div class="col-sm-4 col-sm-offset-4">
	
	<hr />
	
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
		),array('id'=>'mybtn','class'=>'class1 class2 btn btn-block btn-success', 'onclick'=>"this.disabled=true;"));
	?>
	
	<hr />
	
</div>

<?php $this->endWidget(); ?>

<script>
	$('#fotos-form').ready(function(){
		$('#fotos-form').on('click', '#boton-ubicaciones', function(){
			if ($('#Fotos_direccion').val() != "")
				porNombre($('#Fotos_direccion').val());
			return false;
		});
		
		seleccionaUbicacion();
	});

</script>