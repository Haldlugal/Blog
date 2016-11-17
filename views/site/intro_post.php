<div class="post">
	<h4><?=$post->title?></h4>
	<p> Author: <?=$author?></p>
	<table class="post_info">
		<tr>
			<td>
				<img src="/web/images/date.png" alt="Дата" />
			</td>
			<td>
				<p><?=$post->date?></p>
			</td>
		</tr>
	</table>
	<div class="post_text">
		<?=$post->description?>
		<div class="clear"></div>
	</div>
	<p class="more">
		<a href="<?=$post->link?>">Читать полностью</a>
	</p>
	<hr />
</div>