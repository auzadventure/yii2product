<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menucat".
 *
 * @property int $id
 * @property string $name
 * @property int $sortOrder
 */
class Menucat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menucat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'sortOrder'], 'required'],
            [['sortOrder'], 'integer'],
            [['name'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'sortOrder' => 'Sort Order',
        ];
    }
}
