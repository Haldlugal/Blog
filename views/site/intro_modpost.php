<div>
	<h4><?=$post->id.".".$post->title?></h4>
	<p> Author: <?=$post::findAuthorNameById($post->user_id)->name." ".$post::findAuthorNameById($post->user_id)->second_name?></p>
	<p> Date: <?=$post->date?> </p>
	<p> Description: </p> 
	<p> <?=$post->description?> </p>
	<a href="<?=Yii::$app->urlManager->createUrl(['site/moderatepost', 'id'=>$post->id])?>"> Модерировать пост </a>
	<hr />
</div>