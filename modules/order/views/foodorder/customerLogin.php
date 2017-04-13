<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Customer Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h3>Existing Customer</h3>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'inline',
        'fieldConfig' => [
            //'template' => "{label}\n<div class=\"col-lg-2\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')
			->textInput(['autofocus' => true,'placeholder'=>'email'])
			->label(false) ?>

        <?= $form->field($model, 'password')
			->passwordInput(['placeholder'=>'password'])
			->label(false) ?>


        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    <div style="color:#999;">
        You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
        To modify the username/password, please check out the code <code>app\models\User::$users</code>.
    </div>
	
	
		<h3> Guest Login </h3>
	<div class="col-lg-12">
		<?= Html::a('Guest CheckOut',['foodorder/create'],['class'=>'btn btn-primary']) ?>
	</div>
	
</div>
