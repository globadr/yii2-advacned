<?php

namespace frontend\models\shop;

use yii\db\ActiveRecord;

class Contact extends ActiveRecord
{
    public static function tableName()
    {
        return 'contacts';
    }

    public function attributeLabels()
    {
        return [
            'menuItemName' => \Yii::t('app/shop/contact', 'menuItemName'),
            'lastname' => \Yii::t('app/shop/contact', 'lastname'),
            'firstname' => \Yii::t('app/shop/contact', 'firstname'),
            'contactId' => \Yii::t('app/shop/contact', 'contactId'),
        ];
    }
}