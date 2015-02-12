<?php

/**
 * This is the model class for table "fotos".
 *
 * The followings are the available columns in table 'fotos':
 * @property integer $id
 * @property string $nombre_original
 * @property string $nombre
 * @property string $size
 * @property string $type
 * @property string $fec_alta
 * @property string $fec_act
 * @property integer $usuario_id
 * @property integer $categoria_id
 *
 * The followings are the available model relations:
 * @property Usuarios $usuario
 * @property Categorias $categoria
 */
class Fotos extends CActiveRecord
{
	public $fotografia;
	public $verifyCode;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Fotos the static model class
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
		return 'fotos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('categoria_id', 'required'),
				array('usuario_id, categoria_id', 'numerical', 'integerOnly'=>true),
				array('nombre_original, nombre, size, type, ruta, estado, municipio, marca', 'length', 'max'=>255),
				array('descripcion', 'safe'),
				array('fotografia', 'file', 'types'=>'jpg', 'maxSize'=>1024*1024*10, 'on'=>'insert'),
				array('verifyCode', 'captcha', 'on'=>'captchaRequired'),
				//array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'captcaAction' => 'site/captcha'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, nombre_original, nombre, ruta, size, type, marca, fec_alta, fec_act, usuario_id, categoria_id', 'safe', 'on'=>'search'),
		);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see CActiveRecord::beforeSave()
	 */
	public function beforeSave()
	{
		if (!$this->isNewRecord)
			return parent::beforeSave();
		
		$usuario = Usuarios::model()->findByPk(Yii::app()->user->id_usuario);
		if (in_array($this->categoria, $usuario->usuarios_categorias())){
			$this->addError($this->categoria_id, 'Solo se puede subir una fotografía por categoria.');
			return false;
		}
			
		$foto = CUploadedFile::getInstance($this, 'fotografia');		
		$this->size = $foto->getSize();
		$this->type = $foto->getType();
		$this->nombre_original = $foto->getName();	
		$extension = substr($this->nombre_original, -3);	
		$this->usuario_id = $usuario->id;
		$this->nombre = date("Y-m-d_H-i-s")."_".$usuario->id.".".$extension;
		$this->fec_alta = date("Y-m-d_H-i-s");

		$acentos = array('Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
				'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
				'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
				'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
				'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y');
		
		$categoria = strtr($this->categoria->nombre, $acentos);
		$categoria = str_replace(" ", "_", $categoria);
		$categoria = strtolower($categoria);
		
		if($usuario->edad > 17)
		{
			$url = Yii::app()->baseUrl.'/imagenes/fotografias/adultos/'.$categoria; 
			$ruta = Yii::app()->basePath.'/../imagenes/fotografias/adultos/'.$categoria;
			if (!file_exists($ruta))
				mkdir($ruta, 0755, true);
			$this->ruta = $url;
		}
		else 
		{
			$url = Yii::app()->baseUrl.'/imagenes/fotografias/jovenes/'.$categoria;
			$ruta = Yii::app()->basePath.'/../imagenes/fotografias/jovenes/'.$categoria;
			if (!file_exists($ruta))
				mkdir($ruta, 0755, true);
			$this->ruta = $url;
		}
		$foto->saveAs($ruta."/".$this->nombre);
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
				'usuario' => array(self::BELONGS_TO, 'Usuarios', 'usuario_id'),
				'categoria' => array(self::BELONGS_TO, 'Categorias', 'categoria_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'nombre_original' => 'Nombre Original',
				'nombre' => 'Nombre',
				'size' => 'Size',
				'type' => 'Type',
				'fec_alta' => 'Fec Alta',
				'fec_act' => 'Fec Act',
				'usuario_id' => 'Usuario',
				'categoria_id' => 'Categoría',
				'fotografia' => 'Fotografía',
				'municipio' => 'Delegación / Municipio',
				'descripcion' => 'Breve descripción',
				'marca' => 'Marca/modelo de tu cámara fotográfica'
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
		$criteria->compare('nombre_original',$this->nombre_original,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('size',$this->size,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('fec_alta',$this->fec_alta,true);
		$criteria->compare('fec_act',$this->fec_act,true);
		$criteria->compare('usuario_id',$this->usuario_id);
		$criteria->compare('categoria_id',$this->categoria_id);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}

	/**
	 * Muestra las categorias que deben de ir
	 */
	public function categorias($form=NULL, $model=NULL)
	{
		$usuario = Usuarios::model()->findByPk(Yii::app()->user->id_usuario);
		$categorias_usuario = $usuario->usuarios_categorias();
		
		if (count($categorias_usuario) > 0)
		{
			$lista = "<select name=\"Fotos[categoria_id]\" id=\"Fotos_categoria_id\">";
			$lista.= "<option>--Selecciona---</option>";
			$categorias = Categorias::model()->findAll();

			foreach ($categorias as $c)
			{
				if (in_array($c->id, $categorias_usuario))
					$lista.= "<option disabled>".$c->nombre."</option>";
				else
					$lista.= "<option value=\"".$c->id."\">".$c->nombre."</option>";
			}
			$lista.= "</select>";
		} else
			$lista = $form->dropDownList($model, 'categoria_id', 
					CHtml::listData(Categorias::model()->findAll(), 'id', 'nombre'),
					array('prompt'=>'---Selecciona---'));
		return $lista;	
	}
}