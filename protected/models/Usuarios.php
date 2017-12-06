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
    public $cambia_passwd = false;

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
            array('usuario, nombre, apellido, correo, municipio, estado, compromiso, difusion, fecha_nac','required'),
            array('acepto_terminos, passwd, confirma_passwd', 'required', 'on'=>'insert'),
            array('confirmo distribucion', 'numerical', 'integerOnly'=>true),
            array('usuario, nombre, apellido, fecha_nac correo, telefonos, passwd, confirma_passwd, salt, municipio, estado', 'length', 'max'=>255),
            array('compromiso', 'safe'),
            array('acepto_terminos', 'acepto_terminos_rule', 'on'=>'insert'),
            array('correo', 'valida_correo', 'on'=>'insert'),
            array('usuario', 'valida_usuario', 'on'=>'insert'),
            array('fecha_nac', 'valida_fecha_nac', 'on'=>'insert'),
            array('confirma_passwd', 'valida_passwd'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, usuario, nombre, apellido, fecha_nac, correo, telefonos, municipio, estado, confirmo,
				difusion,  fec_alta, fec_act', 'safe', 'on'=>'search'),
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
                $this->addError($this->correo, 'Ese correo ya fue registrado por alguien más, por favor intenta con otro o recupera tu contraseña desde el inicio de sesión.');
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
                $this->addError($this->usuario, 'Este usuario ya fue registrado por alguien más, por favor intenta con otro o recupera tu contraseña desde el inicio de sesión.');
        }
    }
    public function valida_fecha_nac(){
        $regex = '/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/';
        if (!preg_match($regex, $this->fecha_nac)) {
            $this->addError($this->fecha_nac, 'Lo sentimos, la fecha no es válida'.$this->fecha_nac);
            return false;
        }

        $edad = $this::dameEdad($this->fecha_nac);

        if ($edad < 6)
        {
            $this->addError($this->fecha_nac, 'Lo sentimos, la edad mínima para participar es 6 años.');
            return false;
        }
        if ($edad > 130)
        {
            $this->addError($this->fecha_nac, 'Lo sentimos, la edad máxima para participar es 130 años.');
            return false;
        }
    }

    public static function dameEdad($fecha_nac){
        $d1 = new DateTime(Yii::app()->params->fecha_termino);
        $d2 = new DateTime($fecha_nac);
        $diff = $d2->diff($d1);
        return $diff->y;
    }

    public function valida_passwd()
    {
        if(empty($this->para_confirmar) && !$this->cambia_passwd)  //Para evitar cuando se guarda confirmo y la fecha
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
            'videos' => array(self::HAS_MANY, 'Videos', 'usuario_id')
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
            'apellido' => 'Apellido(s)',
            'fecha_nac' => 'Fecha de nacimiento',
            'correo' => 'Correo electrónico',
            'telefonos' => 'Teléfono(s)',
            'passwd' => 'Contraseña',
            'salt' => 'Salt',
            'municipio' => 'Delegación / Municipio',
            'estado' => 'Estado',
            'confirmo' => 'Confirmo',
            'distribucion' => 'Acepto suscripción anual a la revista digital "Espacio Profundo"',
            'fec_alta' => 'Fecha de alta',
            'fec_act' => 'Fecha de última actualización',
            'acepto_terminos' => 'Acepto términos y condiciones',
            'confirma_passwd' => 'Confirma contraseña',
            'compromiso' => 'Compromiso',
            'difusion' => '¿Cómo te enteraste del concurso?'
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
        $criteria->compare('fecha_nac',$this->fecha_nac);
        $criteria->compare('correo',$this->correo,true);
        $criteria->compare('telefonos',$this->telefonos,true);
        $criteria->compare('passwd',$this->passwd,true);
        $criteria->compare('salt',$this->salt,true);
        $criteria->compare('municipio',$this->municipio,true);
        $criteria->compare('estado',$this->estado,true);
        $criteria->compare('confirmo',$this->confirmo);
        $criteria->compare('distribucion',$this->distribucion);
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
            'Ciudad de México' => 'Ciudad de México',
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

    public static function difusiones()
    {
        return array
        (
            'Redes sociales' => 'Redes sociales',
            'Medios impresos' => 'Medios impresos',
            'Radio' => 'Radio',
            'Televisión' => 'Televisión',
            'Otros' => 'Otros'
        );
    }

    public function send_mail()
    {

        ini_set("SMTP", "xolo.conabio.gob.mx");
        ini_set("sendmail_from", "noreply@conabio.gob.mx");

        $imagen = "<table border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
        $imagen.= "<tbody><tr><td align=\"center\" bgcolor=\"#333333\">";
        $imagen.= "<div style=\"background:url('http://www.mosaiconatura.net/img/bg-registro.jpg') no-repeat center center scroll;\"><img src=\"http://www.mosaiconatura.net/img/logo-mosaiconatura.png\" border=\"0\"></div>";
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

    public function send_mail_recupera()
    {
        ini_set("SMTP", "xolo.conabio.gob.mx");
        ini_set("sendmail_from", "noreply@conabio.gob.mx");

        $imagen = "<table border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
        $imagen.= "<tbody><tr><td align=\"center\" bgcolor=\"#333333\">";
        $imagen.= "<div style=\"background:url('http://www.mosaiconatura.net/img/bg-registro.jpg') no-repeat center center scroll;\"><img src=\"http://www.mosaiconatura.net/img/logo-mosaiconatura.png\" border=\"0\"></div>";
        $imagen.= "</td></tr></tbody></table>";
        $para = $this->correo.", mosaiconatura@conabio.gob.mx";
        $titulo = 'Recuperar contraseña '.Yii::app()->name;
        $mensaje = $imagen."<br><br>".$this->nombre.' '.$this->apellido.",";
        $mensaje.= "<br><br>Para poder poner una nueva contrase&ntilde;a sigue el siguiente ";
        $mensaje.= "<a href=\"".Yii::app()->createAbsoluteUrl('site/reset')."?id=".$this->id."&fec_alta=".urlencode($this->fec_alta)."\" target=\"_blank\">enlace</a>.";

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
