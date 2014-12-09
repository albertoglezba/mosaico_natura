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
			array('nombre_original, nombre, size, type, fec_alta, fec_act, usuario_id, categoria_id', 'required'),
			array('usuario_id, categoria_id', 'numerical', 'integerOnly'=>true),
			array('nombre_original, nombre, size, type', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre_original, nombre, size, type, fec_alta, fec_act, usuario_id, categoria_id', 'safe', 'on'=>'search'),
		);
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
			'categoria_id' => 'Categoria',
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
}