<?php
namespace app\models;

use yii\base\Model;

class AddUserForm extends Model
{
	public $name;
	public $second_name;
	public $patronymic_name;
	public $job_place;
	public $job_position;
	public $username;
	public $role;
	public $activation;
	public $password;
	
	public function rules()
	{
		return [
			['name', 'required', 'message' => 'Введите имя'],
			['second_name', 'required', 'message' => 'Введите фамилию'],
			['patronymic_name', 'required', 'message' => 'Введите отчество'],
			['job_place', 'required', 'message' => 'Введите место работы'],
			['job_position', 'required', 'message' => 'Введите должность'],
			['username', 'required', 'message' => 'Введите имя пользователя в системе'],
			['role', 'required', 'message' => 'Введите роль'],
			['activation', 'required', 'message' => 'Введите активен ли пользователь'],
			['password', 'required', 'message' => 'Введите пароль'],
						
		];
	}
}

?>