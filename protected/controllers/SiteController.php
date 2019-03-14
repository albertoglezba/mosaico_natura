<?php

class SiteController extends Controller
{
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
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		//Yii::import('ext.tcpdf.*');
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
						"Reply-To: {$model->email}\r\n".
						"MIME-Version: 1.0\r\n".
						"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->vigencia ();
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
				
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
			{
				$this->setIdUsuario(Yii::app()->user->id);
				$this->redirect(Yii::app()->request->baseUrl."/index.php/site/logged");
			}
		}

		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionLogged()
	{
		$usuario = Usuarios::model()->findByPk( Yii::app()->user->id_usuario );
		if(Usuarios::deboActualizarFechaNac($usuario->fecha_nac)){
			$this->redirect(Yii::app()->baseUrl."/index.php/usuarios/update/".$usuario->id);
		}else{
			$this->redirect(Yii::app()->baseUrl."/index.php/usuarios/".$usuario->id);

		}

	}

	/**
	 * Pone la ventana de mantenimiento
	 */
	public function actionMaintenance()
	{
		$this->render('maintenance');
	}
	
	/**
	 * Para recuperar la contrasenia
	 */
	public function actionRecupera()
	{
		$this->vigencia();
		$this->render('recupera');
	}
	
	/**
	 * Para mandar el correo a la direccion que anoto
	 */
	public function actionEnvia_correo()
	{
		$this->vigencia();
		$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
		$this->vigencia();
		$this->layout = false;
		header('Content-type: application/json');
			
		// Validacion en el modelo para mayor seguridad
		if(isset($_POST['correo']) && preg_match($regex, $_POST['correo']))
		{
			$usuario = Usuarios::model()->findByAttributes(array('correo'=>$_POST['correo']));
			
			if (isset($usuario->id))
			{
				$usuario->send_mail_recupera();
				echo json_encode(array('estatus' => '1', 'msj' => 'El correo esta en proceso de enviarse, ¡gracias!'));
			}
			else
				echo json_encode(array('estatus' => '0', 'msj' => 'El correo proporcionado no se encuentra registrado, por favor verifica.'));
		
		} else
			echo json_encode(array('estatus' => '0', 'msj' => 'El correo no puede ser vacio.'));
		
		Yii::app()->end();
	}
	
	/**
	 * Cuando le da click al enlace del correo
	 */
	public function actionReset()
	{	
		$this->vigencia();
		
		if (isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['fec_alta']) && !empty($_GET['fec_alta']))
		{
			$usuario = Usuarios::model()->findByPk($_GET['id']);
			
			if ($usuario == NULL)
				throw new CHttpException(404,'Hubo un error en la petición.');
			elseif ($usuario->fec_alta == urldecode($_GET['fec_alta']))
				$this->render('reset', array('usuario'=>$usuario));
			else
				throw new CHttpException(404,'Hubo un error en la petición.');
		} else
			throw new CHttpException(404,'Hubo un error en la petición.');
	}
	
	/**
	 * Cuando envio la nueva contrasenia
	 */
	public function actionNueva_contrasenia()
	{
		$this->vigencia();
		$this->layout = false;
		header('Content-type: application/json');

		if (isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['fec_alta']) && !empty($_POST['fec_alta']) && isset($_POST['passwd']) && !empty($_POST['passwd']))
		{
			$usuario = Usuarios::model()->findByPk($_POST['id']);
			
			if ($usuario == NULL)
				echo json_encode(array('estatus' => '0', 'msj' => 'Hubo un error en la petición.'));
			
			elseif ($usuario->fec_alta == $_POST['fec_alta'])
			{
				$usuario->passwd = $_POST['passwd'];
				$usuario->cambia_passwd = true;
				
				if ($usuario->save()){
					echo json_encode(array('estatus' => '1', 'msj' => 'Tu contraseña se ha cambiado satisfactoriamente, trata de ingresar con tus nuevas credenciales.'));
				}
				else
					echo json_encode(array('estatus' => '0', 'msj' => 'Hubo un error en la petición.'));
	
			} else
				echo json_encode(array('estatus' => '0', 'msj' => 'Hubo un error en la petición.'));
		} else
			echo json_encode(array('estatus' => '0', 'msj' => 'Hubo un error en la petición.'));
		
		Yii::app()->end();
	}

	public function actionPage($alias)
	{
		echo "This is $alias.";
	}

	public function actionTerminos_condiciones()
	{
		//$this->layout = false;
		$this->render('terminos_condiciones');
	}

	public function actionConfirma()
	{
		$this->vigencia();
		if (isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['fec_alta']) && !empty($_GET['fec_alta']))
		{
			$usuario = Usuarios::model()->findByPk($_GET['id']);
			if ($usuario != NULL)
			{
				if ($usuario->fec_alta == urldecode($_GET['fec_alta']))
					$usuario->send_mail();
			}
		}
		$this->render('confirma');
	}
	
	public function actionAws()
	{
		$this->render('aws');
	}
	
	public function actionEstadisticas(){
		$stats = Usuarios::model()->dameEstadisticas();
		$this->render('estadisticas',array(
					'stats'=>$stats
			));
	}
}