<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\Users;

class Posts extends ActiveRecord
{
	public $link;
		
	public function afterFind(){
		$this->link = Yii::$app->urlManager->createUrl(["site/post", "id" => $this->id]);
	}
	
	public function findAuthorNameById($user_id){
		return Users::find()->where(['id'=>$user_id])->one();
	}
	public function showDate() {
		$date = date_create($this->date); 
		echo date_format($date, 'Y-m-d H:i');
	}
}
?>