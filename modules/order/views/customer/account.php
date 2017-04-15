<?php
/* @var $this yii\web\View */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>


<div class="customer-account">    

<?php if (Yii::$app->session->hasFlash('success')): ?>
  <div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <span class="glyphicon glyphicon-ok"></span>   
  <?= Yii::$app->session->getFlash('success') ?>

  </div>
<?php endif; ?>



<h2> Welcome <?= $model->name?>, </h2>
Manage Your Account Here
	<br>
	
	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'name')->textInput() ?>
	<?= $form->field($model, 'address')->textInput() ?>
	<?= $form->field($model, 'email')->textInput() ?>
	<?= $form->field($model, 'contactNo')->textInput() ?>
	<?= $form->field($model, 'pass')->textInput() ?>
	 <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
	<?php ActiveForm::end(); ?>
	
	
	
	
</div>