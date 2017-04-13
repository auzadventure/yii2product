<?php

namespace app\modules\order\controllers;

use app\models\Customer;
use yii;
use yii\web\Response;

class CustomerController extends \yii\web\Controller
{
	//from foodorder/create , return array if exists 
	public function actionAjax_get() {
		Yii::$app->response->format = Response::FORMAT_JSON;
		
		$email = $_POST['p_email']; 
		$pass  = $_POST['p_pass'];
		
		$model = Customer::findOne(['email'=>$email]);
		
		if($model!==null) {
			if($model->pass == $pass) {
				$c_status = 2;
				$c_model = $model;
			}
			else {
				$c_status = 1;
				$c_model = '';
			}
		}
		else {
			$c_status = 0;
			$c_model = '';
		}
		return ['c_status' => $c_status,'c_model'=>$c_model];
	}

}
