<?php
namespace app\models;

use yii\base\Model;

class AddPostForm extends Model
{
	public $title;
	public $text;
	public $description;
	public $moderation;
	
	public function rules()
	{
		return [
			['title', 'required', 'message' => 'Введите название поста'],
			['text', 'required', 'message' => 'Введите основной текст поста'],
			['description', 'required', 'message' => 'Введите краткое описание поста'],
			['moderation','default','value'=>'0']
		];
	}
}

?>