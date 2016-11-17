<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

$this->title = "Добавить статью";

?>
	
	<?php $form = ActiveForm::begin(); ?>
		
		<?= $form->field($model, 'title')->label('Название'); ?>
				
		<?= $form->field($model, 'description')->widget(CKEditor::className(), [
			'options' => ['rows' => 6],
			'preset' => 'basic'
		])->label('Описание'); ?>
				
		<?= $form->field($model, 'text')->widget(CKEditor::className(), [
			'options' => ['rows' => 6],
			'preset' => 'basic'
		])->label('Полный текст статьи'); ?>		
		
		<?= Html::submitButton('Добавить статью', ['class' => 'bg_center'])?>
							
		
	<?php ActiveForm::end(); ?>
</div>
				
