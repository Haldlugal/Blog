<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

	
	<?php $form = ActiveForm::begin(); ?>
		<?= $form->field($model, 'name')->textInput(array('value'=>$user->name))->label('Имя'); ?>
		<?= $form->field($model, 'second_name')->textInput(array('value'=>$user->second_name))->label('Фамилия'); ?>
		<?= $form->field($model, 'patronymic_name')->textInput(array('value'=>$user->patronymic_name))->label('Отчество'); ?>
		<?= $form->field($model, 'job_place')->textInput(array('value'=>$user->job_place))->label('Место работы'); ?>
		<?= $form->field($model, 'job_position')->textInput(array('value'=>$user->job_position))->label('Должность'); ?>
		<?= $form->field($model, 'username')->textInput(array('value'=>$user->username))->label('Имя пользователя в системе'); ?>
		<?= $form->field($model, 'password')->textInput(array('value'=>$user->password))->label('Пароль'); ?>
		<?= $form->field($model, 'role')->dropDownList(['Admin'=>'admin', 'User'=>'user'])->label('Роль'); ?>
		<?= $form->field($model, 'activation')->checkbox()->label('Активация'); ?>
		
		<?= Html::submitButton('Сохранить данные пользователя', ['class' => 'bg_center'])?>
		<p><a href="<?=Yii::$app->urlManager->createUrl(['site/deleteuser', "id" => $user->id])?>">Удалить пользователя</a></p>					
	<?php ActiveForm::end(); ?>
						"<p><a href='<?=Yii::$app->urlManager->createUrl(['site/userlist'])?>'>Список пользователей</a></p>"; 