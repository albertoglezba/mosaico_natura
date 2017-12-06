<?php

class FotosController extends Controller
{
	protected function beforeAction($event)
	{
		$usuario = Usuarios::model()->findByPk( Yii::app()->user->id_usuario );
		$edad_actualizada = $usuario->fecha_nac == '9999-01-01' ? false : true;
		if(!$edad_actualizada){
			$this->redirect('/index.php');
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
						'actions'=>array('index','create','update','formulario_fotos','formulario_fotos_editar','aws'),
						'users'=>array('@'),
				),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions'=>array('view','admin','delete'),//,'renombra','borra'),
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
		$this->vigencia ();
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
		$usuario = Usuarios::model()->findByPk( Yii::app()->user->id_usuario );
		$puede_subir = Fotos::conCategoriasDisponibles();
		
		if (isset ( $usuario->edad )) {
			if ($puede_subir) {
				$adulto = $usuario->edad > 17 ? '1' : '0';
				$this->render ( 'create', array (
						'adulto' => $adulto 
				) );
			} else
				throw new CHttpException ( NULL, "Lo sentimos pero ya has subido el límite de fotografías permitidas. Para más información consulta la convocatoria." );
		} else
			throw new CHttpException ( NULL, "Ocurrió un error, por favor inténtalo de nuevo." );
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * 
	 * @param integer $id
	 *        	the ID of the model to be updated
	 */
	public function actionUpdate($id) {
		$this->vigencia ();
		$model = $this->loadModel ( $id );
		
		if (( int ) Yii::app ()->user->id_usuario == $model->usuario_id) {
			$this->render ( 'formulario_fotos_editar', array (
					'model' => $model 
			) );
		} else
			throw new CHttpException ( NULL, 'Lo sentimos, no estás autorizado para realizar esta acción.' );
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
		$dataProvider=new CActiveDataProvider('Fotos', array(
				'criteria'=>array(
						'condition'=>'usuario_id='.Yii::app()->user->id_usuario,
						'order'=>'fec_alta DESC',
				)));
		$this->render('index',array(
				'dataProvider'=>$dataProvider,
		));
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
	public function actionFormulario_fotos() {
		$this->vigencia ();
		$this->layout = false;
		$model = new Fotos ();
		$this->performAjaxValidation ( $model );
		
		if (isset ( $_POST ['Fotos'] )) {
			$model->attributes = $_POST ['Fotos'];
			$model->fec_alta = self::fechaAlta ();
			$model->usuario_id = Yii::app ()->user->id_usuario;
			
			$valid = $model->validate ();

			if ($valid) {
				if ($model->save ()) {
					echo CJSON::encode ( array (
							'status' => 'success' 
					) );
					Yii::app ()->end ();
				}
			} else {
				$error = CActiveForm::validate ( $model );
				if ($error != '[]')
					echo $error;
				Yii::app ()->end ();
			}
		}
		
		$this->render ( 'formulario_fotos', array (
				'model' => $model 
		) );
	}
	
	/**
	 * Formulario de fotos llamado desde ajax
	 */
	public function actionFormulario_fotos_editar($id) {
		$this->vigencia ();
		$model = $this->loadModel ( $id );
		$this->performAjaxValidation ( $model );
		
		if (isset ( $_POST ['Fotos'] )) {
			$model->attributes = $_POST ['Fotos'];
			$valid = $model->validate ();
			
			if ($valid) {
				if ($model->save ()) {
					echo CJSON::encode ( array (
							'status' => 'success' 
					) );
					Yii::app ()->end ();
				}
			} else {
				$error = CActiveForm::validate ( $model );
				if ($error != '[]')
					echo $error;
				Yii::app ()->end ();
			}
		}
	}
	
	/**
	 * La vista del AWS
	 */
	public function actionAws() {
		$this->vigencia ();
		$this->layout = false;
		
		if (isset ( $_POST ['adulto'] ) && $_POST ['adulto'] == '1' && isset ( $_POST ['categoria'] )) {
			$categoria_obj = Categorias::model ()->findByPk ( ( int ) $_POST ['categoria'] );
			
			if (! empty ( $categoria_obj )) {
				$acentos = array (
						'Š' => 'S',
						'š' => 's',
						'Ž' => 'Z',
						'ž' => 'z',
						'À' => 'A',
						'Á' => 'A',
						'Â' => 'A',
						'Ã' => 'A',
						'Ä' => 'A',
						'Å' => 'A',
						'Æ' => 'A',
						'Ç' => 'C',
						'È' => 'E',
						'É' => 'E',
						'Ê' => 'E',
						'Ë' => 'E',
						'Ì' => 'I',
						'Í' => 'I',
						'Î' => 'I',
						'Ï' => 'I',
						'Ñ' => 'N',
						'Ò' => 'O',
						'Ó' => 'O',
						'Ô' => 'O',
						'Õ' => 'O',
						'Ö' => 'O',
						'Ø' => 'O',
						'Ù' => 'U',
						'Ú' => 'U',
						'Û' => 'U',
						'Ü' => 'U',
						'Ý' => 'Y',
						'Þ' => 'B',
						'ß' => 'Ss',
						'à' => 'a',
						'á' => 'a',
						'â' => 'a',
						'ã' => 'a',
						'ä' => 'a',
						'å' => 'a',
						'æ' => 'a',
						'ç' => 'c',
						'è' => 'e',
						'é' => 'e',
						'ê' => 'e',
						'ë' => 'e',
						'ì' => 'i',
						'í' => 'i',
						'î' => 'i',
						'ï' => 'i',
						'ð' => 'o',
						'ñ' => 'n',
						'ò' => 'o',
						'ó' => 'o',
						'ô' => 'o',
						'õ' => 'o',
						'ö' => 'o',
						'ø' => 'o',
						'ù' => 'u',
						'ú' => 'u',
						'û' => 'u',
						'ý' => 'y',
						'ý' => 'y',
						'þ' => 'b',
						'ÿ' => 'y' 
				);
				
				$categoria = strtr ( $categoria_obj->nombre, $acentos );
				$categoria = str_replace ( " ", "_", $categoria );
				$categoria = strtolower ( $categoria );
				
				$this->render ( 'aws', array (
						'categoria' => $categoria,
						'categoria_id' => $_POST ['categoria'],
						'usuario' => Yii::app ()->user->id_usuario,
						'fecha' => date ( "Y-m-d_His_" ),
						'material' => 'fotografias',
						'adulto' => $_POST ['adulto'] 
				) );
			} else
				throw new CHttpException ( NULL, 'Lo sentimos, no estás autorizado para realizar esta acción.' );
		} else if (isset ( $_POST ['adulto'] ) && $_POST ['adulto'] == '0')
			$this->render ( 'aws', array (
					'categoria' => "",
					'categoria_id' => '0',
					'usuario' => Yii::app ()->user->id_usuario,
					'fecha' => date ( "Y-m-d_His_" ),
					'material' => 'fotografias',
					'adulto' => $_POST ['adulto'] 
			) );
		else
			throw new CHttpException ( NULL, 'Lo sentimos, no estás autorizado para realizar esta acción.' );
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
		$model=Fotos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'La página solicitada no existe..');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Fotos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='fotos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
