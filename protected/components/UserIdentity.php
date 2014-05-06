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
	public function authenticate()
	{
        $userData=Yii::app()->db->createCommand("
            SELECT CONCAT_WS(' ',username,password) FROM tbl_user
        ")->queryColumn();
        $compareString=$this->username." ".md5($this->password);
        if(in_array($compareString,$userData))
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}
}