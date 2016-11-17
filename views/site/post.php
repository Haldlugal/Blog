<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $post->title;
?>
<div class="post">
	<h1><?=$post->title?></h1>
	<p> Author: <?=$author->name." ".$author->second_name?></p>
	<p><img src="/web/images/date.png" alt="Дата" /><?=$post->showDate()?></p>
	<p><?=$post->text?></p>
</div>
<a href="<?=Yii::$app->urlManager->createUrl(['site/editpost', 'id'=>$post->id])?>"> Редактировать статью </a>
<hr />
<hr />
<div id="comments">
	<?php 
		foreach ($comments as $comment){
			foreach ($users as $user)
			{
				if($user->id==$comment->user_id)
				{
					$comment_author=$user->name." ".$user->second_name;
					break;
				}
			}
			include "show_comments.php";
		}
	?>
	<?php $form1 = ActiveForm::begin(); ?>
	<p>Добавить комментарий: </p>
	<?= $form1->field($model, 'text')->textarea(['rows' => '6'])->label(''); ?>
	<?= Html::submitButton('Добавить комментарий', ['class' => 'bg_center'])?>
	<?php ActiveForm::end(); ?>
</div>