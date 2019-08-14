<?php

/**
 * This is the model class for table "Post".
 *
 * The followings are the available columns in table 'Post':
 * @property integer $id
 * @property string $texto
 * @property string $autor
 * @property string $titulo
 * @property string $dataPost
 * @property integer $idUser
 * @property integer $idCategoria
 */
class Post extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Post the static model class
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
		return 'Post';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('texto, autor, titulo, dataPost, idUser, idCategoria', 'required'),
			array('idUser, idCategoria', 'numerical', 'integerOnly'=>true),
			array('texto', 'length', 'max'=>500),
			array('autor, titulo', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, texto, autor, titulo, dataPost, idUser, idCategoria', 'safe', 'on'=>'search'),
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
			'comentarios' => array(self::HAS_MANY, 'Comentario', 'idPost'),
			'idCategoria0' => array(self::BELONGS_TO, 'Categoria', 'idCategoria'),
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
			'autor' => 'Autor',
			'titulo' => 'Titulo',
			'dataPost' => 'Data Post',
			'idUser' => 'Id User',
			'idCategoria' => 'Id Categoria',
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

		$criteria->compare('autor',$this->autor,true);

		$criteria->compare('titulo',$this->titulo,true);

		$criteria->compare('dataPost',$this->dataPost,true);

		$criteria->compare('idUser',$this->idUser);

		$criteria->compare('idCategoria',$this->idCategoria);

		return new CActiveDataProvider('Post', array(
			'criteria'=>$criteria,
		));
	}
}