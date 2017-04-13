<?php

namespace app\modules\order\controllers;

use Yii;
use app\models\FoodOrder;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\modules\order\components\IpnListener;
use app\modules\order\components\NexmoMessage;

use app\models\Menuitem;
use app\models\Foodorderitem;
/**
 * FoodorderController implements the CRUD actions for FoodOrder model.
 */
class FoodorderController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

	/*turn off csrf validation for paypal */
	public function beforeAction($action)
	{            
		if ($action->id == 'paypal_return' ||
			$action->id == 'paypal_ipn'
			
			) {
			$this->enableCsrfValidation = false;
		}

		return parent::beforeAction($action);
	}	
	
	
    /**
     * Lists all FoodOrder models.
     * @return mixed
     */
	// The Menu Page  
    public function actionMenu()
    {
		$models= MenuItem::find()->where(['status'=>1])->all();
		
		
		return $this->render('menu',['models'=>$models]);
    }

    /**
     * Displays a single FoodOrder model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new FoodOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
		
	 
    public function actionCreate()
    {
        $model = new FoodOrder();

        if ($model->load(Yii::$app->request->post())) {
			$model->status = FoodOrder::$STATUS_PAID;
			$model->datetimeCreate = Yii::$app->params['datetimeSQL'];
			$model->save();

			//gets from session 
			$session = Yii::$app->session;
			$items = json_decode($session['items']);
			Foodorderitem::addItems($model->id,$items);
			
			
			// send 1 to customer , 1 to kitchen 

			// forwards to paypal 
			/*$model = FoodOrder::findOne(1);
			
			return $this->render('paypal',[
						'model'=>$model
				]);
			*/
	
			
            return $this->redirect(['/orderAdmin/foodorder/index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
	
	public function actionPaypal_return() {
		$sms = new NexmoMessage ('fa39000d','bc6a995b');
		
		$to = '6596674603';
		$from = 'WESVAULT';
		$msg = 'NEXMO TEST';
		$sms->sendText ( $to,$from,$msg );
	}
	
	public function actionPaypal_cancel() {
		
	}
	
	public function actionPaypal_ipn() {

		$listener = new IpnListener();
		try {
				$listener->requirePostMethod();
				$verified = $listener->processIpn();
			} catch (Exception $e) {
				error_log($e->getMessage());
				exit(0);
			}	
	

			if ($verified) {
			// 1 update paypal info 

			// change status to $STATUS_PAID 
			
			// sms SMS 
			
			
			
			
			} else {
			//show error
			}	
		
	}

    /**
     * Updates an existing FoodOrder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FoodOrder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FoodOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FoodOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FoodOrder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
