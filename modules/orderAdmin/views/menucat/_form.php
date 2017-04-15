<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Menucat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menucat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?php
		if ($model->isNewRecord==1) {
			$count = count($model->find()->all())+1; 
			$valueA = ['value'=>$count];
		}
		else $valueA = [];
	?>
    <?= $form->field($model, 'sortOrder')->textInput($valueA) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
