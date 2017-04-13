<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FoodOrder */

$this->title = 'Create Food Order';
$this->params['breadcrumbs'][] = ['label' => 'Food Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
