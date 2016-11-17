<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>
<div id="addpost">
	<h2>Заполните форму</h2>
	<?php $form = ActiveForm::begin(); ?>
		<table>
			<tr>
				<td>Название:</td>
				<td>
					 <?= $form->field($model, 'title')->textInput(array('value'=>$post->title,))->label(''); ?>
				</td>
			</tr>
			<tr>
				<td colspan="2">Описание (не более 255 символов):</td>
			</tr>
			<tr>
				<td colspan="2">
					<?= $form->field($model, 'description')->textarea(['rows' => '6', 'value' => $post->description])->label(''); ?>
				</td>
			</tr>
			<tr>
				<td colspan="2">Текст поста</td>
			</tr>
			<tr>
				<td colspan="2">
					<?= $form->field($model, 'text')->textarea(['rows' => '6', 'value' => $post->text])->label(''); ?>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="hidden" name="func" value="addsite" />
					<table class="button_subscribe">
						<tr>
							<td>
								
							</td>
							<td class="center">
								<?= Html::submitButton('Изменить пост', ['class' => 'bg_center'])?>
							</td>
							<td>
								
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	<?php ActiveForm::end(); ?>
</div>						