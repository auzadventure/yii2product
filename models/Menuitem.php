<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menuitem".
 *
 * @property int $id
 * @property int $menuCatID
 * @property string $name
 * @property string $des
 * @property string $price
 * @property string $image
 * @property int $status
 */
class Menuitem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	
	 
	 
    public static function tableName()
    {
        return 'menuitem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menuCatID', 'name', 'des', 'price', 'status'], 'required'],
            [['menuCatID', 'status'], 'integer'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 150],
            [['des'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'menuCatID' => 'Menu Cat ID',
            'name' => 'Name',
            'des' => 'Description',
            'price' => 'Price',
            'image' => 'Image',
            'status' => 'Status',
        ];
    }
	
	public function getMenucat()
    {
        return $this->hasOne(Menucat::className(), ['id' => 'menuCatID']);
    }

	public function getStatus($key=null) {
		$a = [
			0=>'hide',
			1=>'show'
		];
		if($key!=null) return $a[$key];
		else return $a;
	}
	
	
}
