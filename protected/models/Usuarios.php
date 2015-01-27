<?php

/**
 * This is the model class for table "usuarios".
 *
 * The followings are the available columns in table 'usuarios':
 * @property integer $id
 * @property string $usuario
 * @property string $nombre
 * @property string $apellido
 * @property string $correo
 * @property string $telefonos
 * @property string $passwd
 * @property string $salt
 * @property string $calle_y_numero
 * @property string $colonia
 * @property string $municipio
 * @property string $estado
 * @property string $cp
 * @property integer $confirmo
 * @property string $fec_alta
 * @property string $fec_act
 *
 * The followings are the available model relations:
 * @property Fotos[] $fotoses
 */
class Usuarios extends CActiveRecord
{
	/**
	 * @var string, Verifica si acepto terminos y condiciones
	 */
	public $acepto_terminos = false;
	public $confirma_passwd = "";
	public $para_confirmar = false;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Usuarios the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuarios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('usuario, nombre, apellido, edad, correo, calle_y_numero, colonia, municipio, estado, cp', 'required'),
				array('acepto_terminos, passwd, confirma_passwd', 'required', 'on'=>'insert'),
				array('confirmo, edad', 'numerical', 'integerOnly'=>true),
				array('usuario, nombre, apellido, correo, telefonos, passwd, confirma_passwd, salt, calle_y_numero, colonia, municipio, estado', 'length', 'max'=>255),
				array('cp', 'length', 'min' => 5, 'max'=>5),
				array('acepto_terminos', 'acepto_terminos_rule', 'on'=>'insert'),
				array('correo', 'valida_correo', 'on'=>'insert'),
				array('usuario', 'valida_usuario', 'on'=>'insert'),
				array('edad', 'valida_edad', 'on'=>'insert'),
				array('confirma_passwd', 'valida_passwd'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, usuario, nombre, apellido, edad, correo, telefonos, calle_y_numero, colonia, municipio, estado, cp, confirmo, fec_alta, fec_act', 'safe', 'on'=>'search'),
		);
	}

	public function acepto_terminos_rule()
	{
		if ($this->acepto_terminos != '1')
			$this->addError($this->acepto_terminos, 'Debes aceptar los términos y condiciones para proseguir');
	}

	public function valida_correo()
	{
		$regex = '/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3})$/';
		if (!preg_match($regex, $this->correo))
			$this->addError($this->correo, 'El correo no parece válido. Favor de verificar');
		else {
			$correo_existe = $this->model()->findByAttributes(array('correo'=>$this->correo));
			if ($correo_existe != NULL)
				$this->addError($this->correo, 'Ese correo ya fue registrado por alguien más, por favor intenta con otro.');
		}
	}

	public function valida_usuario()
	{
		if (strlen($this->usuario) <= 2)
			$this->addError($this->usuario, 'El campo usuario debe tener al menos 3 caracteres.');
		elseif (preg_match('/\s/',$this->usuario))
		$this->addError($this->usuario, 'El campo usuario no debe tener espacios.');
		else {
			$usuario_existe = $this->model()->findByAttributes(array('usuario'=>$this->usuario));
			if ($usuario_existe != NULL)
				$this->addError($this->usuario, 'Este usuario ya fue registrado por alguien más, por favor intenta con otro.');
		}
	}

	public function valida_edad()
	{
		if ($this->edad < 6)
		{
			$this->addError($this->edad, 'Lo sentimos, la edad mínima para participar es 6 años.');
			return false;
		}
		if ($this->edad > 130)
		{
			$this->addError($this->edad, 'Lo sentimos, la edad máxima para participar es 130 años.');
			return false;
		}
	}

	public function valida_passwd()
	{
		if(empty($this->para_confirmar))  //Para evitar cuando se guarda confirmo y la fecha
		{
			if ($this->passwd != $this->confirma_passwd)
				$this->addError($this->passwd, 'La contraseña no coincide con la confirmación.');
		}
	}

	/**
	 * (non-PHPdoc)
	 * @see CActiveRecord::beforeSave()
	 */
	public function beforeSave()
	{
		if ($this->isNewRecord)
		{
			$this->salt = rand()*rand() + rand();
			$this->passwd = md5($this->passwd."|".$this->salt);
		} else {
			if (empty($this->passwd))
			{
				$usuario = $this->findByPk($this->id);
				$this->passwd = $usuario->passwd;
			} else {
				if (empty($this->para_confirmar))  //Para evitar cuando se confirma 
				{
					$this->salt = rand()*rand() + rand();
					$this->passwd = md5($this->passwd."|".$this->salt);
				}
			}
		}
		return parent::beforeSave();
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
				'fotos' => array(self::HAS_MANY, 'Fotos', 'usuario_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'usuario' => 'Usuario',
				'nombre' => 'Nombre(s)',
				'apellido' => 'Apellido',
				'eadad' => 'Edad',
				'correo' => 'Correo',
				'telefonos' => 'Teléfonos',
				'passwd' => 'Contraseña',
				'salt' => 'Salt',
				'calle_y_numero' => 'Calle y número',
				'colonia' => 'Colonia / Asentamiento',
				'municipio' => 'Delegación / Municipio',
				'estado' => 'Estado',
				'cp' => 'Código postal',
				'confirmo' => 'Confirmo',
				'fec_alta' => 'Fecha de alta',
				'fec_act' => 'Fecha de última actualización',
				'acepto_terminos' => 'Acepto términos y condiciones',
				'confirma_passwd' => 'Confirma contraseña'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('usuario',$this->usuario,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('edad',$this->edad);
		$criteria->compare('correo',$this->correo,true);
		$criteria->compare('telefonos',$this->telefonos,true);
		$criteria->compare('passwd',$this->passwd,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('calle_y_numero',$this->calle_y_numero,true);
		$criteria->compare('colonia',$this->colonia,true);
		$criteria->compare('municipio',$this->municipio,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('cp',$this->cp,true);
		$criteria->compare('confirmo',$this->confirmo);
		$criteria->compare('fec_alta',$this->fec_alta,true);
		$criteria->compare('fec_act',$this->fec_act,true);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}

	public static function estados()
	{
		return array
		(
				'Aguascalientes' => 'Aguascalientes',
				'Baja California' => 'Baja California',
				'Baja California Sur' => 'Baja California Sur',
				'Campeche' => 'Campeche',
				'Chiapas' => 'Chiapas',
				'Chihuahua' => 'Chihuahua',
				'Coahuila' => 'Coahuila',
				'Colima' => 'Colima',
				'Distrito Federal' => 'Distrito Federal',
				'Durango' => 'Durango',
				'Estado de México' => 'Estado de México',
				'Guanajuato' => 'Guanajuato',
				'Guerrero' => 'Guerrero',
				'Hidalgo' => 'Hidalgo',
				'Jalisco' => 'Jalisco',
				'Michoacán' => 'Michoacán',
				'Morelos' => 'Morelos',
				'Nayarit' => 'Nayarit',
				'Nuevo León' => 'Nuevo León',
				'Oaxaca' => 'Oaxaca',
				'Puebla' => 'Puebla',
				'Querétaro' => 'Querétaro',
				'Quintana Roo' => 'Quintana Roo',
				'San Luis Potosí' => 'San Luis Potosí',
				'Sinaloa' => 'Sinaloa',
				'Sonora' => 'Sonora',
				'Tabasco' => 'Tabasco',
				'Tamaulipas' => 'Tamaulipas',
				'Tlaxcala' => 'Tlaxcala',
				'Veracruz' => 'Veracruz',
				'Yucatán' => 'Yucatán',
				'Zacatecas' => 'Zacatecas'
		);
	}

	public function send_mail()
	{
		$imagen = "<table width=\"990\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
		$imagen.= "<tbody><tr><td width=\"200\" align=\"center\" bgcolor=\"#000000\">";
		$imagen.= "<img src=\"http://www.mosaiconatura.net/images/logo_mosaicon_natura.png\" width=\"153\" height=\"79\" border=\"0\">";
		$imagen.= "</td><td width=\"790\" align=\"center\" bgcolor=\"#FFFFFF\">";
		$imagen.= "<img	src=\"http://www.mosaiconatura.net/images/barraLogos.png\" width=\"707\" height=\"79\">";
		$imagen.= "</td></tr></tbody></table>";

		$para = $this->correo.", mosaiconatura@conabio.gob.mx";
		$titulo = 'Registro para el '.Yii::app()->name;
		$mensaje = $imagen."<br><br>".$this->nombre.' '.$this->apellido.",";
		$mensaje.= "<br><br>Gracias por completar el registro, para poder acceder necesitas confirmar tu cuenta en el siguiente ";
		$mensaje.= "<a href=\"".Yii::app()->createAbsoluteUrl('usuarios/confirmo')."?id=".$this->id."&fec_alta=".urlencode($this->fec_alta)."\" target=\"_blank\">enlace</a>.";
		$cabeceras = "Content-type: text/html; charset=utf-8"."\r\n";
		$cabeceras.= "From: noreply@conabio.gob.mx"."\r\n";
		mail($para, $titulo, $mensaje, $cabeceras);
	}

	/**
	 * Da las categorias que ya no puede tomar (una foto por categoria)
	 */
	public function usuarios_categorias()
	{
		$categorias = array();
		foreach ($this->fotos as $f)
		{
			array_push($categorias, $f->categoria->id);
		}
		return $categorias;
	}
}
