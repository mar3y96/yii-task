<?php

	/** @var yii\web\View $this */

	use yii\helpers\Html;

	$this->title = 'My Yii Application';
?>
<div class="site-index">

	<div class="jumbotron text-center bg-transparent">
		<h1 class="display-4">Welcome!</h1>
	</div>

	<div class="body-content">

		<div class="row ">
			<div class="col-lg-6">

				<p>
					<?= Html::a('Categories', ['/category/index'], ['class' => 'btn btn-lg btn-success'])
					?></p>
			</div>
			<div class="col-lg-6 d-flex flex-row-reverse bd-highlight">

				<p>
					<?= Html::a('Products', ['/product/index'], ['class' => 'btn btn-lg btn-info']) ?>
				</p>
			</div>

		</div>

	</div>
</div>
