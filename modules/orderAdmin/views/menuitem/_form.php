<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use app\models\Menucat;

/* @var $this yii\web\View */
/* @var $model app\models\Menuitem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menuitem-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $menuCatA = ArrayHelper::map(Menucat::find()
								->orderBy('name')->all(),'id','name'); ?>
	
	<?= $form->field($model, 'menuCatID')->dropDownList($menuCatA) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'des')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

	<?php if($model->isNewRecord==1) $model->status = 1;?>
    <?= $form->field($model, 'status')->dropDownList($model->getStatus()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
