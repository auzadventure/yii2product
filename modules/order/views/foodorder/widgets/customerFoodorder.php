<?php 
namespace app\modules\order\views\foodorder\widgets;

use app\models\Foodorder;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

class CustomerFoodorder extends Widget
{
    public $email;
	public $dataProvider;

    public function init()
    {
		
		$query = Foodorder::find()->where(['email'=>$this->email])
								   ->orderBy('datetimeCreate DESC');
								    
		
		
		$this->dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => 20,
			]
			]);
		
		
	
    }

    public function run()
    {

		return ListView::widget([
			'dataProvider' => $this->dataProvider,
			'class' => 'list-group',
			'itemView' => function ($model,$key,$index,$widget) {
							return $this->itemView($model,$key,$index,$widget);
						 },
		]);	
		
		
	}
	
	private function itemView($model,$key,$index,$widget) {
		
	return <<<EOD
		<div class='list-group-item '> 
			<div class="col-xs-4 col-sm-3">{$model->id} </div>;
			<div class="col-xs-4 col-sm-3">{$model->datetimeCreate}</div>
			<div class="col-xs-4 col-sm-3">{$model->total}</div>
		</div>
EOD;

		
	}
}