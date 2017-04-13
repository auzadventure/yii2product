<?php
/* @var $this yii\web\View */

use app\models\Foodorderitem;
use yii\helpers\Html;
use app\modules\orderAdmin\views\foodorder\widgets\IndexToolBar;
?>
<?= IndexToolBar::widget(); ?>

<h1>Food Order - Shipped</h1>

<style>
ol {
	padding: 0 0 0 15px;

}

ol li {
	margin: 2px 0;
}

.float_right {
	float: right;
	
}
.center {
	text-align:center;
}


</style>
<div class="row">
<?php 
$i=0;
foreach ($models as $model) : ?>


  <div class="col-sm-4 col-md-3">
	<div class="panel panel-success">
	  <div class="panel-heading">
	  <strong>#<?=$model->id?> <?=$model->name?></strong> <span class='float_right'>
	  <?php echo $model->timeDiffMin($model->datetimeClose)?> min ago</span> 
	  
	  </div>
	  <div class="panel-body">
		<div>
		<p><span class="glyphicon glyphicon-home"></span> <span class='float_right'><?= $model->address;?></span></p>
		<p><span class="glyphicon glyphicon-usd"></span>  <span class='float_right'><?= $model->total;?></span> </p>
		<p><span class="glyphicon glyphicon-phone"></span> <span class='float_right'><?= $model->contactNo;?></span> </p>  
		</div>
		<hr>
		<ol>
		<?php $foodItems = 	Foodorderitem::getItems($model->id); ?>
		<?php foreach ($foodItems as $foodItem) :?>
			<li> <?=$foodItem->menuItem->name ?> 
			     <span class='float_right badge'><?=$foodItem->qty?></span>
			</li>
		<?php endforeach;?>
		
		</ol> 
	  </div>
		<div class="panel-footer">
		<p>
		<strong>Time Paid:</strong> <span class='float_right'> 
			<?php echo $model->datetimeCreateF()?></p>
		<p>
		<strong>Paid:</strong> <span class='float_right'> 
			<?php echo $model->timeDiffMin($model->datetimeCreate)?> min ago</p>
		<p>
		<strong>Shipped:</strong> <span class='float_right'> 
			<?php echo $model->timeDiffMin($model->datetimeClose)?> min ago </p>	
		</div>
	 
	</div>
  
  
  </div>




<?php endforeach; ?>
</div>
