<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Menuitem */

$this->title = 'Create Menuitem';
$this->params['breadcrumbs'][] = ['label' => 'Menuitems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menuitem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
