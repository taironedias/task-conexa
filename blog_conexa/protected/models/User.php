<?php

/**
 * This is the model class for table "User".
 *
 * The followings are the available columns in table 'User':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 */
class User extends CActiveRecord
{	
	public $confirmPassword;
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
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
		return 'User';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, confirmPassword, email', 'required'),
			array('username, password, email', 'length', 'max'=>128),
			array('password, confirmPassword', 'compareEqual'),
			array('id, username, password, email', 'safe', 'on'=>'search'),
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
			'comentarios' => array(self::HAS_MANY, 'Comentario', 'idUser'),
			'posts' => array(self::HAS_MANY, 'Post', 'idUser'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'username' => 'Nome usuário',
			'password' => 'Senha',
			'confirmPassword' => 'Confirmar senha',
			'email' => 'E-mail',
		);
	}

	public function compareEqual() {
		if(!$this->hasErrors()) {
			
			if ($this->password !== $this->confirmPassword)
				$this->addError('confirmPassword','As senhas são distintas.');
		}
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

		$criteria->compare('username',$this->username,true);

		$criteria->compare('password',$this->password,true);

		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider('User', array(
			'criteria'=>$criteria,
		));
	}
}