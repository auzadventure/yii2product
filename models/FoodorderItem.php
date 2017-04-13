<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "foodorderitem".
 *
 * @property int $id
 * @property int $foodOrderID
 * @property int $menuItemID
 * @property int $qty
 * @property string $subTotal
 */
class FoodorderItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'foodorderitem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['foodOrderID', 'menuItemID', 'qty'], 'required'],
            [['foodOrderID', 'menuItemID', 'qty'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'foodOrderID' => 'Food Order ID',
            'menuItemID' => 'Menu Item ID',
            'qty' => 'Qty',
            'subTotal' => 'Sub Total',
        ];
    }
	
	public function getMenuItem()
    {
        return $this->hasOne(MenuItem::className(), ['id' => 'menuItemID']);
    }	
	
	// add several items to a food order 
	public function addItems($foodOrderID,$itemA) {
		
		foreach ($itemA as $item) {
			$foodOrderItem = new FoodorderItem();
			$foodOrderItem->foodOrderID = $foodOrderID;
			$foodOrderItem->menuItemID = $item->itemID;
			$foodOrderItem->qty = $item->qty;
			$foodOrderItem->save();
			
			
			
			/* print_r($foodOrderItem->getErrors());
			echo $item->itemID;
			echo $item->qty; 
			echo "Add {$foodOrderID}<br>";
			*/
			
		
		}
	}	
		
	public function getTotal($foodOrderID) {
		$models = FoodOrderItem::find()->where(['foodOrderID'=>$foodOrderID])->all();
		
		$total = 0;
		foreach ($models as $model) {
			$total = $model->qty * $model->menuItem->price + $total;
		}
		return $total; 
	}		
	
	//get items 
	public function getItems($foodOrderID) {
		$models = FoodOrderItem::find()->where(['foodOrderID'=>$foodOrderID])
									   ->orderBy('id')
									   ->all();
		return $models;
	}
	
}
