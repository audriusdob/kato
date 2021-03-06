<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\models\search\BlockSearch $model
 * @var yii\bootstrap\ActiveForm $form
 */
?>

<div class="block-search">

	<?php $form = ActiveForm::begin([
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'title') ?>

		<?php // echo $form->field($model, 'create_time') ?>

		<?php // echo $form->field($model, 'created_by') ?>

		<?php // echo $form->field($model, 'update_time') ?>

		<?php // echo $form->field($model, 'updated_by') ?>

		<?php // echo $form->field($model, 'parent') ?>

		<?php // echo $form->field($model, 'listing_order') ?>

		<?php // echo $form->field($model, 'status') ?>

		<?php // echo $form->field($model, 'deleted') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
