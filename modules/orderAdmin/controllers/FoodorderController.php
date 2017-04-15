<?php

namespace app\modules\orderAdmin\controllers;

use app\models\Foodorder;
use Yii;

class FoodorderController extends \yii\web\Controller
{
    public function actionIndex()
    {
        
		if(@$_POST['process']!='') {
			$model = Foodorder::findOne($_POST['Foodorder']['id']);
			$model->status = $model::$STATUS_PROCESS;
			$model->datetimeClose = Yii::$app->params['datetimeSQL'];
			if($model->save()) {
				Yii::$app->session->setFlash('success', "#{$model->id} Order Processed!");
				
				return $this->redirect(['index']);
			}
		}
		
		if(@$_POST['cancel']!='') {
			$model = Foodorder::findOne($_POST['Foodorder']['id']);
			//$model->status = $model::$STATUS_CANCEL;
			$model->datetimeClose = Yii::$app->params['datetimeSQL'];
			if($model->save()) {
				Yii::$app->session->setFlash('cancel', "#{$model->id} Order Cancelled!");
				
				return $this->redirect(['index']);
			}
		}		
		
		//get all paid
		$models = Foodorder::find()->where([
						'status'=>Foodorder::$STATUS_PAID
						])
				  ->orderBy('datetimeCreate')
				  ->all();
				
		return $this->render('index',['models'=>$models]);
    }

   public function actionIndexprocessed()
    {
 
		if(@$_POST['ship']!='') {
			$model = Foodorder::findOne($_POST['Foodorder']['id']);
			$model->status = $model::$STATUS_SHIPPED;
			$model->datetimeClose = Yii::$app->params['datetimeSQL'];
			if($model->save()) {
				Yii::$app->session->setFlash('success', "#{$model->id} Order Shipped!");
				
				return $this->redirect(['indexprocessed']);
			}
		}




		//get all paid
		$models = Foodorder::find()->where([
						'status'=>Foodorder::$STATUS_PROCESS
						])
				  ->orderBy('datetimeClose')
				  ->all();
		
		return $this->render('indexProcessed',['models'=>$models]);
    }

   public function actionIndexshipped()
    {
        //get all paid
		$models = Foodorder::find()->where([
						'and',
						['status'=>Foodorder::$STATUS_SHIPPED],
						['>','datetimeClose',"DATE_SUB(".Yii::$app->params['datetimeSQL'].",INTERVAL 10 HOUR"], 
						])
				  ->orderBy('datetimeClose DESC')
				  ->all();
		
		return $this->render('indexShipped',['models'=>$models]);
    }	
}
