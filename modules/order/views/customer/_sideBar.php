<?php 

use yii\helpers\Html;

$class = 'list-group-item list-group-item-action';
?>

<br>
<div class="list-group">
  <div class="list-group-item list-group-item-success">
    Options
  </div>
  <?= Html::a('My Account',['account'],["class"=>$class])?>
  <?= Html::a('Orders',['foodorders'],["class"=>$class])?>
  <?= Html::a('Logout',['logout'],["class"=>$class])?>
</div>

