<div>
	<h4><?=$user->id.".".$user->second_name." ".$user->name." ".$user->patronymic_name?></h4>
	<p> Job place: <?=$user->job_place?></p>
	<p> Job position: <?=$user->job_position?></p>
	<p> Username: <?=$user->username?></p>
	<p> Role in blog: <?=$user->role?></p>
	<p> Activation: <?=$user->active?></p>
	<a href="<?=$user->link?>"> Редактировать данные пользователя</a>
	<hr />
</div>