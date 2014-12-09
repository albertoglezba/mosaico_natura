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
 * @property integer $confimo
 * @property string $fec_alta
 * @property string $fec_act
 *
 * The followings are the available model relations:
 * @property Fotos[] $fotoses
 */
class Usuarios extends CActiveRecord
{
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
			array('usuario, nombre, apellido, correo, telefonos, passwd, salt, calle_y_numero, colonia, municipio, estado, cp, fec_alta, fec_act', 'required'),
			array('confimo', 'numerical', 'integerOnly'=>true),
			array('usuario, nombre, apellido, correo, telefonos, passwd, salt, calle_y_numero, colonia, municipio, estado, cp', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, usuario, nombre, apellido, correo, telefonos, passwd, salt, calle_y_numero, colonia, municipio, estado, cp, confimo, fec_alta, fec_act', 'safe', 'on'=>'search'),
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
			'fotoses' => array(self::HAS_MANY, 'Fotos', 'usuario_id'),
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
			'nombre' => 'Nombre',
			'apellido' => 'Apellido',
			'correo' => 'Correo',
			'telefonos' => 'Telefonos',
			'passwd' => 'Passwd',
			'salt' => 'Salt',
			'calle_y_numero' => 'Calle Y Numero',
			'colonia' => 'Colonia',
			'municipio' => 'Municipio',
			'estado' => 'Estado',
			'cp' => 'Cp',
			'confimo' => 'Confimo',
			'fec_alta' => 'Fec Alta',
			'fec_act' => 'Fec Act',
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
		$criteria->compare('correo',$this->correo,true);
		$criteria->compare('telefonos',$this->telefonos,true);
		$criteria->compare('passwd',$this->passwd,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('calle_y_numero',$this->calle_y_numero,true);
		$criteria->compare('colonia',$this->colonia,true);
		$criteria->compare('municipio',$this->municipio,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('cp',$this->cp,true);
		$criteria->compare('confimo',$this->confimo);
		$criteria->compare('fec_alta',$this->fec_alta,true);
		$criteria->compare('fec_act',$this->fec_act,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}