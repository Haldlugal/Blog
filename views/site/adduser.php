<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div id="addpost">
	<h2>Заполните форму</h2>
	
	<?php $form = ActiveForm::begin(); ?>
		<?= $form->field($model, 'name')->label('Имя'); ?>
		<?= $form->field($model, 'second_name')->label('Фамилия'); ?>
		<?= $form->field($model, 'patronymic_name')->label('Отчество'); ?>
		<?= $form->field($model, 'job_place')->label('Место работы'); ?>
		<?= $form->field($model, 'job_position')->label('Должность'); ?>
		<?= $form->field($model, 'username')->label('Имя пользователя в системе'); ?>
		<?= $form->field($model, 'password')->label('Пароль'); ?>
		<?= $form->field($model, 'role')->dropDownList(['Admin'=>'admin', 'User'=>'user'])->label('Роль'); ?>
		<?= $form->field($model, 'activation')->checkbox()->label('Активация'); ?>
		
		<?= Html::submitButton('Добавить пользователя', ['class' => 'bg_center'])?>
							
	<?php ActiveForm::end(); ?>
</div>						