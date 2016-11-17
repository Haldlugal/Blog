<?php
use yii\widgets\LinkPager;

$this->title = "Многопользовательский блог";

$this->registerMetaTag([
	'name' => 'description',
	'content' => 'Многопользовательский блог на Yii2 Framework'
]);
$this->registerMetaTag([
	'name' => 'keywords',
	'content' => 'Yii2 framework многопользовательский блог'
])

?>
<p><a href="<?=Yii::$app->urlManager->createUrl(['site/addpost'])?>">Добавить пост</a></p>
<?php 
echo $useraddlink;
echo $postmoderationlink;
?>

<?php
	foreach ($posts as $post)
	{
		foreach ($users as $user)
		{
			if($user->id==$post->user_id)
			{
				$author=$user->name." ".$user->second_name;
				break;
			}
		}
		include "intro_post.php";
	}
	
		
?>
<br />
<hr />
<div id="pages">
	<?= LinkPager::widget([
		'pagination' => $pagination,
		'firstPageLabel' => 'В начало',
		'lastPageLabel' => 'В конец',
		'prevPageLabel' => '&laquo;'
	]) ?>
	<span>Страница <?=$active_page?> из <?=$count_pages?></span>
	<div class="clear"></div>
</div>