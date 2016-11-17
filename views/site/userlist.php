

<p><a href="<?=Yii::$app->urlManager->createUrl(['site/adduser'])?>">Добавить пользователя</a></p>
<?php
	foreach ($users as $user)
	{
		include "intro_user.php";
	}
?>
<hr />
