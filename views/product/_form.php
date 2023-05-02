<?php

	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

	/** @var yii\web\View $this */
	/** @var app\models\Product $model */
	/** @var yii\widgets\ActiveForm $form */
	/** @var array $categories */
?>

<div class="product-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

	<?= $form->field($model, 'category_id')->label('Category')->dropDownList
	(\yii\helpers\ArrayHelper::map($categories, 'id', 'title')) ?>

	<?= $form->field($model, 'image')->fileInput(['class' => 'form-control']) ?>
	<input type="hidden" name="old_image" value="<?= $model->image ?>" id="">

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
