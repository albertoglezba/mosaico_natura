<?php $yii_path = Yii::app()->request->baseUrl; ?>

<?php if ($adulto == '1') { ?>

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

    <h3 class="text-left"><b>Primer paso</b>, elige una categoría <br />
        <small class="text-left text-warning">(Recuerda que solo puedes subir hasta <?php echo Yii::app()->params['#_fotos_adulto_x_categoria']; ?> fotografías por categor&iacute;a, una vez procesada no se permiten hacer cambios)</small>
    </h3>

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'categoria-form',
        'htmlOptions'=>array(
            'class'=>'form-horizontal'
        ),
        'enableAjaxValidation'=>false )); ?>

        <div class="form-group text-left">
            <?php $model=new Fotos; ?>

            <?php echo CHtml::label('Categoria','categoria_id', array('class'=>'col-sm-1 control-label')); ?>
            <div class="col-sm-5">
                <?php echo $model->categorias($form, $model); ?>
                <?php echo $form->error($model,'categoria_id'); ?>

            </div>
        </div>


    <?php $this->endWidget(); ?>

<?php } else { ?>

    <script type="text/javascript">
        $(document).ready(function(){

            $.ajax({
                method: "POST",
                url: "<?php echo Yii::app()->request->baseUrl; ?>" + "/index.php/fotos/aws",
                data: {adulto: "<?php echo $adulto; ?>"}
            }).done(function( html ) {
                $('#formulario_completo').append(html);
            });
        });
    </script>

    <h3 class="text-left">Primer paso</em>, selecciona una fotografía <br />
        <small>(Para la categoria de jóvenes se permiten hasta <?php echo Yii::app()->params['#_fotos_juvenil']; ?> fotografías)</small>
    </h3>
    <h5 class="text-warning"><b>(Debe ser un .jpg con 3000px como mínimo en su lado más grande)</b></h5>

<?php } ?>

<div id='formulario_completo'></div>


