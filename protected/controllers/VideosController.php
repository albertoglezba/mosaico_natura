<?php

class VideosController extends Controller
{
	protected function beforeAction($event){
		$usuario = Usuarios::model()->findByPk( Yii::app()->user->id_usuario );
		//$edad_actualizada = $usuario->fecha_nac == '9999-01-01' ? false : true;
		$edad_actualizada = ((Usuarios::dameEdad($usuario->fecha_nac) > 6 ) && (Usuarios::dameEdad($usuario->fecha_nac) < 130 ));
		if(!$edad_actualizada){
			$this->redirect(Yii::app()->baseUrl."/index.php/usuarios/update/".$usuario->id);
		}
		return true;
	}
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
				// captcha action renders the CAPTCHA image displayed on the contact page
				'captcha'=>array(
						'class'=>'CCaptchaAction',
						'backColor'=>0xFFFFFF,
				),
				// page action renders "static" pages stored under 'protected/views/site/pages'
				// They can be accessed via: index.php?r=site/page&view=FileName
				'page'=>array(
						'class'=>'CViewAction',
				),
		);
	}

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
				'postOnly + delete' // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('index','create','formulario_videos'),
						'users'=>array('@'),
				),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions'=>array('view','admin','delete', 'update'),//,'renombra','borra'),
						'users'=>array('calonso'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
				'model'=>$this->loadModel($id),
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
		$this->vigencia ();
		$puede_subir = Videos::soloUnVideo ();
		$usuario = Usuarios::model ()->findByPk ( Yii::app ()->user->id_usuario );
		$adulto = Usuarios::dameEdad($usuario->fecha_nac) > 17 ? '1' : '0';
		
		if ($puede_subir && $adulto) {
			$this->render ( 'create', array (
					'material' => 'videos',
					'usuario' => Yii::app ()->user->id_usuario,
					'fecha' => date ( "Y-m-d_His_" ) 
			) );
		} else
			throw new CHttpException ( NULL, "Lo sentimos pero no se pueden subir mas videos, el límite es ".Yii::app()->params['#_videos'] );
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->vigencia ();
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Fotos']))
		{
			$model->attributes=$_POST['Fotos'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
				'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->vigencia ();
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->vigencia ();
		$usuario = Usuarios::model ()->findByPk ( Yii::app ()->user->id_usuario );
		$adulto = Usuarios::dameEdad($usuario->fecha_nac) > 17 ? '1' : '0';
		
		if ($adulto)
		{
			$dataProvider=new CActiveDataProvider('Videos', array(
					'criteria'=>array(
							'condition'=>'usuario_id='.Yii::app()->user->id_usuario,
							'order'=>'fec_alta DESC',
					)));
			$this->render('index',array(
					'dataProvider'=>$dataProvider,
			));
			
		} else throw new CHttpException ( NULL, "Lo sentimos pero solo se permiten subir videos en la categoria adulto (mayor de 17 años)" );
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Fotos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Fotos']))
			$model->attributes=$_GET['Fotos'];

		$this->render('admin',array(
				'model'=>$model,
		));
	}

	public function actionRenombra()
	{
		$ruta_prin = realpath ( dirname ( __FILE__ ) ) . "\..\..\..";

		$fh = fopen ( $ruta_prin . "\concurso\protected\data\archivos_binarios_a_renombrar2.csv", 'r' );
		while ( $line = fgets ( $fh ) ) {
			$line = trim ( $line );
			$origen = $ruta_prin . $line;
			$destino = "$ruta_prin$line.jpg";
			echo "[" . $origen . "][" . $destino . "]";
			if (rename ( $origen, $destino ))
				echo "\trenombro<br>";
			else
				echo "\tNO renombro<br>";
		}
		fclose ( $fh );
	}
	
	public function actionBorra()
	{
		$ruta_prin = realpath ( dirname ( __FILE__ ) ) . "\..\..\..";
		$archivos = array("adultos\\plantas_y_hongos_en_vida_silvestre\\2015-02-26_09-49-03_528.jpg","adultos\\fauna_en_vida_silvestre\\2015-02-26_10-24-06_528.jpg");
	
		foreach ($archivos as $k => $a)
		{
			if (unlink($ruta_prin."\\concurso\\imagenes\\fotografias\\".$a))
					echo "Borro: $a";
			else
					echo "No borro: $a";
        	}
    }
    
    /**
     * Formulario de fotos llamado desde ajax
     */
    public function actionFormulario_videos()
    {
    	$this->vigencia ();
    	$this->layout = false;
    	$model=new Videos;
    	$this->performAjaxValidation($model);
    	
    	if(isset($_POST['Videos']))
    	{
    		$model->attributes=$_POST['Videos'];
    		$model->fec_alta=self::fechaAlta();
    		$model->usuario_id=Yii::app()->user->id_usuario;
    		
    		$valid=$model->validate();
    	
    		if ($valid)
    		{
    			if($model->save())
    			{
    				echo CJSON::encode(array(
    						'status'=>'success'
    				));
    				Yii::app()->end();
    			}	
    			
    		} else {
    			$error = CActiveForm::validate($model);
    			if($error!='[]')
    				echo $error;
    			Yii::app()->end();
    		}    			
    	}
    	
    	$this->render('formulario_videos',array(
    			'model'=>$model,
    	));
    }
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Fotos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Videos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Fotos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='videos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
