<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;


class Users extends ActiveRecord implements IdentityInterface
{
	public $link;	
	public static function findByUsername($username)
	{
		return static::findOne(['username'=>$username]);
	}
	
    public function validatePassword($password)
    {
        return $password==$this->password;
    }
	
	public function getId()
    {
        return $this->id;
    }
	
	public static function findIdentity($id){
		
		return static::findOne($id);
	}
	
	public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }
	 public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
	
	public function afterFind(){
		$this->link = Yii::$app->urlManager->createUrl(["site/edituser", "id" => $this->id]);
	}
}
?>