<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
?>

<h1>Regístrate</h1>
    <section id="registro" class="content-section text-center">
        <div class="registro-header">
            <div class="container">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2>REGISTRO</h2>
                </div>
            </div>
        </div>

        <div class="registro-content">
            <div class="container">
                <div class="col-md-12">
                    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
                </div>
            </div>
        </div>

    </section>
