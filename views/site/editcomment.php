<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

	
	<?php $form = ActiveForm::begin(); ?>
		<?= $form->field($model, 'text')->textarea(['rows' => '6', 'value'=>$comment->text])->label(''); ?>		
		<?= Html::submitButton('Сохранить комментарий', ['class' => 'bg_center'])?>
						
	<?php ActiveForm::end(); ?>
						