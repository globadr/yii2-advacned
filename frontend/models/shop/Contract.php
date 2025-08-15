<?php

namespace frontend\models\shop;

use yii\db\ActiveRecord;

class Contract extends ActiveRecord
{
    public static function tableName(): string {
        return 'contracts';
    }

    public function attributeLabels()
    {
        return [
            'menuItemName' => \Yii::t('app/shop/contract', 'menuItemName'),
            'name' => \Yii::t('app/shop/contract', 'name'),
            'amount' => \Yii::t('app/shop/contract', 'amount'),
            'contractId' => \Yii::t('app/shop/contract', 'contractId'),
        ];
    }
}