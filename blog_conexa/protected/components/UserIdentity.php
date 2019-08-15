<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate() {	
		$unUser = User::model()->find('username = :username and password=:password', [':username'=>$this->username, ':password'=>$this->password]);

		if($unUser !== null) {
			$this->id = $unUser->id;
			return !$this->errorCode=self::ERROR_NONE;
		}
		
		return !$this->errorCode=self::ERROR_USERNAME_INVALID;
	}

	public function getId() {
		return $this->id;
	}
}