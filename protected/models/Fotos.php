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
	public $es_adulto = true;

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
				array('nombre_original, nombre, ruta, size, type, titulo, direccion, latitud, longitud', 'required'),
				array('usuario_id, categoria_id', 'numerical', 'integerOnly'=>true),
				array('nombre_original, nombre, type, ruta, latitud, longitud, marca, titulo', 'length', 'max'=>255),
				array('direccion', 'length', 'max'=>500),
				//array('verifyCode', 'captcha', 'on'=>'captchaRequired'),
				//array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'captcaAction' => 'site/captcha'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, nombre_original, nombre, fotografia, ruta, size, type, marca, fec_alta, fec_act, usuario_id, categoria_id', 'safe', 'on'=>'search'),
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
		$categoria = $usuario->fotos(array("condition"=>"categoria_id=".$this->categoria_id));

		if (Usuarios::dameEdad($usuario->fecha_nac) > 17)
		{	
			if (count($categoria) >= Yii::app()->params['#_fotos_adulto_x_categoria'])
			{
				$this->addError($this->categoria_id, "Solo se pueden subir ".Yii::app()->params['#_fotos_adulto_x_categoria']." fotografías por categoría.");
				return false;
			}
		} else {
			$this->categoria_id = NULL;
			if (count($usuario->fotos) >= Yii::app()->params['#_fotos_juvenil'])
				return false;
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
				'direccion' => 'Ubicación',
				'latitud' => 'Latitud',
				'longitud' => 'Longitud',
				'titulo' => 'Título',
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
		$categorias_usuario = array_count_values($usuario->usuarios_categorias());
		
		if (count($categorias_usuario) > 0)
		{
			$lista = "<select name=\"Fotos[categoria_id]\" id=\"Fotos_categoria_id\" class=\"form-control\">";
			$lista.= "<option>-- Selecciona --</option>";
			$categorias = Categorias::model()->findAll();

			foreach ($categorias as $c)
			{
				if (isset($categorias_usuario[$c->id]) && $categorias_usuario[$c->id] >= Yii::app()->params['#_fotos_adulto_x_categoria'])
					$lista.= "<option disabled>".$c->nombre."</option>";
				else
					$lista.= "<option value=\"".$c->id."\">".$c->nombre."</option>";
			}
			$lista.= "</select>";
		} else
			$lista = $form->dropDownList($model, 'categoria_id', 
					CHtml::listData(Categorias::model()->findAll(), 'id', 'nombre'),
					array('prompt'=>'-- Selecciona --', 'class'=>'form-control'));
		return $lista;	
	}
	
	/**
	 * Regresa true si aun puede subir fotografias en alguna categoria, de lo cotrario false
	 */
	public static function conCategoriasDisponibles()
	{
		$usuario = Usuarios::model()->findByPk(Yii::app()->user->id_usuario);

		$edad = Usuarios::dameEdad($usuario->fecha_nac);

		if ($edad < 18){
			return (count($usuario->fotos_jovenes) < Yii::app()->params['#_fotos_juvenil']);
		}	
		
		$categorias_usuario = $usuario->usuarios_categorias();
	
		// Ya no puede subir mas fotografias
		return (count($categorias_usuario) < Yii::app()->params['#_fotos_adulto_x_categoria']*Yii::app()->params['#_categorias']);
	}
}