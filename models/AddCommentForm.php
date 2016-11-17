<?php
namespace app\models;

use yii\base\Model;

class AddCommentForm extends Model
{
	public $text;
		
	public function rules()
	{
		return [
			['text', 'required', 'message' => 'Введите текст комментария'],
			];
	}
}

?>