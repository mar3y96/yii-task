<?php

	use app\models\Category;
	use yii\helpers\Html;
	use yii\helpers\Url;
	use yii\grid\ActionColumn;
	use yii\grid\GridView;
	use yii\widgets\Pjax;

	/** @var yii\web\View $this */
	/** @var yii\data\ActiveDataProvider $dataProvider */

	$this->title = 'Categories';
	$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php Pjax::begin(); ?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'title',
			'description:ntext',
			[
				'attribute' => 'image',
				'format' => 'image',
				'value' => function (Category $model, $index, $datacol) {
					return $model->getImage();
				}],
			[
				'class' => ActionColumn::className(),
				'urlCreator' => function ($action, Category $model, $key, $index, $column) {
					return Url::toRoute([$action, 'id' => $model->id]);
				}
			],
		],
	]); ?>

	<?php Pjax::end(); ?>

</div>
