<?php

	use app\models\Product;
	use yii\helpers\Html;
	use yii\helpers\Url;
	use yii\grid\ActionColumn;
	use yii\grid\GridView;
	use yii\widgets\Pjax;

	/** @var yii\web\View $this */
	/** @var yii\data\ActiveDataProvider $dataProvider */

	$this->title = 'Products';
	$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
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
				'value' => function (Product $model, $index, $datacol) {
					return $model->getImage();
				}],
			[
				'attribute' => 'category_id',
				'value' => function (Product $model, $index, $datacol) {
					return $model->category->title;
				}],
			'created_at:date',
			[
				'class' => ActionColumn::class,
				'urlCreator' => function ($action, Product $model, $key, $index, $column) {
					return Url::toRoute([$action, 'id' => $model->id]);
				}
			],
		],
	]); ?>

	<?php Pjax::end(); ?>

</div>
