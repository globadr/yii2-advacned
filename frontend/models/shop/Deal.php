<?php

namespace frontend\models\shop;

use yii\db\ActiveRecord;

class Deal extends ActiveRecord
{
    public static function tableName()
    {
        return 'deals';
    }

    public function attributeLabels()
    {
        return [
            'menuItemName' => \Yii::t('app/shop/deal', 'menuItemName'),
        ];
    }
}