<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerJsFile('ckeditor/ckeditor.js', ['position' => \yii\web\View::POS_HEAD]);

?>
<div id="addpost">
	<h2>Редактирование статьи</h2>
	<?php $form = ActiveForm::begin();?>
				
		<?= $form->field($model, 'title')->textInput(array('value'=>$post->title,))->label('Название'); ?>
		<?= $form->field($model, 'description')->textarea(['rows' => '6', 'id'=>'ckeditor1', 'value' => $post->description])->label('Описание'); ?>
		<?= $form->field($model, 'text')->textarea(['rows' => '6', 'id'=>'ckeditor2', 'value' => $post->text])->label('Текст'); ?>
		<?= $form->field($model, 'moderation')->checkbox()->label('Модерация'); ?>
		
		
		<?= Html::submitButton('Изменить статью', ['class' => 'bg_center'])?>
		<p><a href="<?=Yii::$app->urlManager->createUrl(['site/deletepost', "id" => $post->id])?>">Удалить статью</a></p>	

	<?php ActiveForm::end();?>
	
</div>						
<script>
	CKEDITOR.replace('ckeditor1');
	CKEDITOR.replace('ckeditor2');
</script>