<?php

/**
 * This is the model class for table "Comentario".
 *
 * The followings are the available columns in table 'Comentario':
 * @property integer $id
 * @property string $texto
 * @property integer $idUser
 * @property integer $idPost
 */
class Comentario extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Comentario the static model class
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
		return 'Comentario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('texto, idUser, idPost', 'required'),
			array('idUser, idPost', 'numerical', 'integerOnly'=>true),
			array('texto', 'length', 'max'=>250),
			array('id, texto, idUser, idPost', 'safe', 'on'=>'search'),
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
			'idPost0' => array(self::BELONGS_TO, 'Post', 'idPost'),
			'idUser0' => array(self::BELONGS_TO, 'User', 'idUser'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'texto' => 'Texto',
			'idUser' => 'Id User',
			'idPost' => 'Id Post',
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

		$criteria->compare('texto',$this->texto,true);

		$criteria->compare('idUser',$this->idUser);

		$criteria->compare('idPost',$this->idPost);

		return new CActiveDataProvider('Comentario', array(
			'criteria'=>$criteria,
		));
	}
}