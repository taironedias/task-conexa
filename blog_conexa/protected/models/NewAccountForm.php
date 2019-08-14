<?php

/**
 * NewAccountForm class.
 * NewAccountForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class NewAccountForm extends CFormModel
{
	public $username;
	public $password;
	public $confirmPassword;
	public $email;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username, password, confirmPassword and email are required
	 * and password needs to be authenticated.
	 */
	public function rules() {
		return array(
			// username, password, confirmPassword and email are required
			array('username, password, confirmPassword, email', 'required'),
			// password needs to be authenticated
			// array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels() {
		return array(
			'username'=>'Nome usuário',
			'password'=>'Senha',
			'confirmPassword'=>'Confirme a senha',
			'email'=>'E-mail',
		);
	}

	/**
	 * Create a new user in the database.
	 */
	public function create() {
		if (!$this->hasErrors()) {
			if($this->password !== $this->confirmPassword)
				$this->addError('confirmPassword','As senhas estão diferentes.');
			if(strpos($this->email, '@') === false)
				$this->addError('email','Não apresenta um e-mail válido!');

			/**
			 * Poderia fazer a verificação se existe o e-mail e username 
			 * já cadastrados no database
			 */

			$act = Yii::app()->db->createCommand(
				'INSERT INTO User (username, password, email) 
				VALUES ('. $this->username .', '. $this->password .', '. $this->email .')'
				)->execute();
			
			if ($act !== null)
				return true;

			return false;
			
		}
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors()) {
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
				// $this->addError('password','Incorrect username or password.');
				$this->addError('password','Nome do usuário ou senha incorretos.');
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE) {
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}
