<?php 
namespace app\modules\orderAdmin\views\foodorder\widgets;

use app\models\Foodorder;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

class IndexToolBar extends Widget
{
    public $message;

    public function init()
    {
		\Yii::$app->view->registerMetaTag([
				'http-equiv' => 'refresh',
				'content' => '120'
			]);
	
    }

    public function run()
    {
        ?>
		
		<?php if(Yii::$app->session->hasFlash('success')):?>
			<div class="alert alert-success alert-dismissible" role="alert">
				<?php echo Yii::$app->session->getFlash('success'); ?>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>		

			</div>
		<?php endif; ?>


		<?php if(Yii::$app->session->hasFlash('cancel')):?>
			<div class="alert alert-warning alert-dismissible" role="alert">
				<?php echo Yii::$app->session->getFlash('cancel'); ?>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>		

			</div>
		<?php endif; ?>
		
		<div class="row">
		<div class="col-lg-9">
			<div class="btn-group btn-group-lg" role='toolbar'>
			  <?= Html::a('Paid',['foodorder/index'],["class"=>"btn btn-default"])?>
			  
			  <?= Html::a('Processed',['foodorder/indexprocessed'],["class"=>"btn btn-default"])?>
			  <?= Html::a('Shipped',['foodorder/indexshipped'],["class"=>"btn btn-default"])?>
			  <?= Html::a('Complete',['foodorder/indexcomplete'],["class"=>"btn btn-default"])?>
			
			</div>
		</div>	
		<div class="col-lg-3" style='font-size:140%;padding-top:15px;'>
		Update: 
		<?= date(Foodorder::$timeF_long,strtotime(Yii::$app->params['datetimeSQL']))?></div>
		
		</div>
		<?php
		
    }
}