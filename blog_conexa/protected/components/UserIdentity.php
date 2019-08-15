<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate() {	
		$unUser = User::model()->find('username = :username', [':username'=>$this->username]);
		$pwUser = User::model()->find('password = :password', [':password'=>$this->password]);

		
		if($unUser !== null && $pwUser !== null) {
			return !$this->errorCode=self::ERROR_NONE;
		}
		
		return !$this->errorCode=self::ERROR_USERNAME_INVALID;
	}
}