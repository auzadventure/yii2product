<?php
use app\models\FoodOrder;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<form action="<?= FoodOrder::$paypalUrl ?>" method="post" name="paypal" id="paypal">
		<!-- Prepopulate the PayPal checkout page with customer details, -->
		<input type="hidden" name="first_name" value="<?= $model->name ?>">
		
		<input type="hidden" name="email" value="<?= $model->email?>">
		<input type="hidden" name="address1" value="<?= $model->address?>">


		<input type="hidden" name="day_phone_b" value="<?= $model->contactNo;?>">

		<input type="hidden" name="cmd" value="_xclick" />

		
		<?= Html::hiddenInput('business',FoodOrder::$paypalBusinessName) ?>
		
		<input type="hidden" name="cbt" value="<?= FoodOrder::$paypalBusinessName ?>" />
		<input type="hidden" name="currency_code" value="<?= FoodOrder::$paypalCurrency ?>" />

		
		<?= Html::hiddenInput('item_name',FoodOrder::$paypalItemName) ?>
		<INPUT TYPE="hidden" name="charset" value="utf-8">

		<!-- Custom value you want to send and process back in the IPN -->
		<?php // Html::hiddenInput('item_number',$model->id) ?>


		<?= Html::hiddenInput('invoice',$model->id) ?>

		<?= Html::hiddenInput('amount',$model->total) ?>

		<?= Html::hiddenInput('return',Url::to(FoodOrder::$paypalReturn,true)) ?>

		<?= Html::hiddenInput('cancel_return',Url::to(FoodOrder::$paypalCancel,true)) ?>
		<!-- Where to send the PayPal IPN to. -->
		
		<?= Html::hiddenInput('notify_url',Url::to(FoodOrder::$paypalIPN,true)) ?>
		<input type="hidden" name="charset" value="UTF-8">
		<?= Html::submitButton() ?>
	</form>	