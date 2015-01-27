<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $id;

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$credenciales = $this->validaLogin($this->username);
		$errores = array();

		if($credenciales != NULL)
		{
			$users=array(
					$this->username => $credenciales->passwd,
					'salt' => $credenciales->salt,
			);
			
			if(!isset($users[$this->username]))
			{
				$this->errorCode=self::ERROR_USERNAME_INVALID;
				$errores['descripcion'] = 'La contraseña no puede ser nula.';
			}
			elseif($users[$this->username]!==md5($this->password."|".$users['salt']))
			{
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
			$errores['descripcion'] = 'Usuario o contraseña inválidos.';
			}
			elseif ($users[$this->username]===md5($this->password."|".$users['salt']))
			{
				if ($credenciales->confirmo == 0)
				{
					$this->errorCode=self::ERROR_UNKNOWN_IDENTITY;
					$error = 'Primero tienes que confirmar tu cuenta con el enlace que se te envió a tu correo. ';
					$error.= '<br><b>NOTA:</b> A veces el correo de confirmaci&oacute;n llega a la carpeta de "spam" o "correo no deseado", ';
					$error.= 'por favor asegurate de revisarlas.';
					$error.= "<br><br>¿No te llego el correo? <a href='".Yii::app()->createAbsoluteUrl('site/confirma')."?id=".$credenciales->id."&fec_alta=".urlencode($credenciales->fec_alta)."' target='_blank'>Enviar de nuevo el correo de confirmación</a>"; 
					$errores['descripcion'] = $error;
				} else
					$this->errorCode=self::ERROR_NONE;
			}
			else
				$this->errorCode=self::ERROR_NONE;
		} else {
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		
		$errores['error'] = !$this->errorCode;
		return $errores;
	}

	/**
	 *
	 * @param string $usr el usuario
	 */
	public function validaLogin($usr)
	{
		$model = Usuarios::model()->findByAttributes(array('usuario'=>$usr));
		if ($model == NULL)
			$model = Usuarios::model()->findByAttributes(array('correo'=>$usr));
		return $model;
	}
}