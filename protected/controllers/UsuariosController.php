<?php

class UsuariosController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
				'postOnly + delete', // we only allow deletion via POST request
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
				array('allow',  // allow all users to perform 'index' and 'view' actions
						'actions'=>array('create', 'confirmo'),
						'users'=>array('*'),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('view','update'),
						'users'=>array('@'),
				),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions'=>array('index','view','admin', 'delete', 'reset_passwd'),
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
		if (Yii::app()->user->id_usuario==$id)
		{
			$this->render('view',array(
					'model'=>$this->loadModel($id),
			));
		} else {
			throw new CHttpException(404,'No tienes permisos para realizar esa acción.');
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$fecha = date("YmdHis");
		if ($fecha < Yii::app()->params->fecha_termino)
		{
			$model=new Usuarios;

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			if(isset($_POST['Usuarios']))
			{
				$model->attributes=$_POST['Usuarios'];
				$model->fec_alta=self::fechaAlta();

				if($model->save())
				{
					$model->send_mail();
					$this->redirect(array('/site/confirma'));
				}
			}

			$this->render('create',array(
					'model'=>$model,
			));
		} else
			throw new CHttpException(404,"El tiempo para registrar tus fotografias ha terminado. Para más información consulta la convocatoria.");
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		if (Yii::app()->user->id_usuario==$id)
		{
			$model=$this->loadModel($id);

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			if(isset($_POST['Usuarios']))
			{
				$model->attributes=$_POST['Usuarios'];
				if($model->save())
					$this->redirect(array('view','id'=>$model->id));
			}

			$this->render('update',array(
					'model'=>$model,
			));
		} else {
			throw new CHttpException(404,'No tienes permisos para realizar esa acción.');
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
		if (Yii::app()->user->id_usuario==$_POST["id"])
		{
			Yii::app()->user->logout();
			$this->loadModel($_POST["id"])->delete();

			//if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(Yii::app()->homeUrl);
		} else
			throw new CHttpException(404,'No tienes permisos para realizar esa acción.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Usuarios');
		$this->render('index',array(
				'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Usuarios('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Usuarios']))
			$model->attributes=$_GET['Usuarios'];

		$this->render('admin',array(
				'model'=>$model,
		));
	}

	public function actionConfirmo()
	{
		if (isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['fec_alta']) && !empty($_GET['fec_alta']))
		{
			$usuario = Usuarios::model()->findByPk($_GET['id']);
			if ($usuario == NULL)
				throw new CHttpException(404,'Hubo un error en la petición.');
			elseif ($usuario->fec_alta == urldecode($_GET['fec_alta']))
			{
				if ($usuario->confirmo == 1)
					throw new CHttpException(404,'Tu cuenta ya ha sido confirmada, intenta ingresar con tus credenciales.');
				else {
					$usuario->confirmo = 1;
					$usuario->fecha_confirmo = self::fechaAlta();
					$usuario->para_confirmar = true;
						
					if ($usuario->save())
						$this->redirect(array('/site/login?situacion='.urlencode('Tu cuenta ha sido confirmada.')));
					else
						throw new CHttpException(404,'Hubo un error en la petición.');
				}
			} else
				throw new CHttpException(404,'Hubo un error en la petición.');
		} else
			throw new CHttpException(404,'Hubo un error en la petición.');
	}

	public function actionReset_passwd()
	{
		$passwd = $_GET['passwd'];
		if (isset($passwd) && !empty($passwd))
		{
			$salt = rand()*rand() + rand();
			$passwd_md5 = md5($passwd."|".$salt);
			
			$this->render('reset_passwd',array('passwd' => $passwd, 'salt'=>$salt, 'passwd_md5' => $passwd_md5));
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Usuarios the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Usuarios::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Usuarios $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='usuarios-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
