<?php

	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

	/** @var yii\web\View $this */
	/** @var app\models\Category $model */
	/** @var \yii\bootstrap5\ActiveForm */
?>

<div class="category-form">

	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

	<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>


	<?= $form->field($model, 'image')->fileInput(['class' => 'form-control']) ?>
	<input type="hidden" name="old_image" value="<?=$model->image?>" id="">
</div>

<?php
	if ($model->image) {
		echo Html::label('current Image');
		echo Html::img($model->getImage());
	}
?>
<div class="form-group mt-4">
	<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
