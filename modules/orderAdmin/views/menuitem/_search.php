<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MenuitemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menuitem-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'menuCatID') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'des') ?>

    <?= $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
