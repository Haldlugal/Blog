<?php $number++?>
<p> Комментарий <?=$number?> </p>
<div class="post">
	<p> Author: <?=$comment_author?></p>
	<p><img src="/web/images/date.png" alt="Дата" /><?php $comment->showDate();?></p>
	<div class="post_text">
		<?=$comment->text?>
		
		<?php 
		if (Yii::$app->user->identity->role=='Admin'){
			echo '<p><span> Допущено модератором: </span><span>';
			if ($comment->moderation==0){
				echo 'Нет.    '.'<a href="'.$comment->modLink().'"> Добавить в отмодерированные </a>';
			}
			else {
				echo 'Да.    '.'<a href="'.$comment->modLink().'"> Убрать из отмодерированных </a>';
			}
		}
			?>
		</span></p>
	<div class="clear"></div>
	</div>
	<?php
		if(Yii::$app->user->identity->role=='Admin' or Yii::$app->user->id==$comment->user_id){
			echo '<p><a href="'.$comment->editLink().'"> Редактировать комментарий </a><a href="'.$comment->deleteLink().'"> Удалить комментарий </a></p>';
		}?>
	<hr />
</div>