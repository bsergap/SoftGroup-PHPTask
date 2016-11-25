<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property string $title
 * @property integer $table_number
 * @property string $estimated_time
 * @property string $condition
 * @property integer $owner_id
 * @property string $created
 */
class Order
    extends ActiveRecord 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'table_number'], 'required'],
            [['table_number'], 'integer'],
            [['estimated_time'], 'safe'],
            [['condition'], 'string'],
            [['title'], 'string', 'max' => 63],
            ['estimated_time', 'date', 'format' => 'yyyy-M-d H:m']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'table_number' => 'Table Number',
            'estimated_time' => 'Estimated Time',
            'condition' => 'Condition',
            'owner_id' => 'Owner',
            'created' => 'Created',
        ];
    }

    public function getOwner() {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
    }

    // public function afterFind() {
    //     parent::afterFind();
    //     return true;
    // }
}
