<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class Comments extends ActiveRecord
{
		
	public function editLink(){		
		return Yii::$app->urlManager->createUrl(['site/editcomment', 'id'=>$this->id]);
	}
	
	
	public function deleteLink(){
		return Yii::$app->urlManager->createUrl(['site/deletecomment', 'id'=>$this->id, 'user_id'=>$this->user_id]);
	}
	
	public function modLink() {
		return Yii::$app->urlManager->createUrl(['site/modcomment', 'id'=>$this->id]);
	}
	public function showDate() {
		$date = date_create($this->date); 
		echo date_format($date, 'Y-m-d H:i');
	}
	
	
		
}