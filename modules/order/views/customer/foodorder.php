<?php
/* @var $this yii\web\View */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

use app\modules\order\views\foodorder\widgets\CustomerFoodorder;
?>


<div class="customer-order">    





<h2> My Orders </h2>

<?= CustomerFoodorder::widget(['email'=>$email]); ?>
	
</div>