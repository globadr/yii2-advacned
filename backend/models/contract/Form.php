<?php

namespace backend\models\contract;

class Form extends \yii\base\Model
{
    public $id;
    public $name;
    public $amount;

    public function attributeLabels()
    {
        return [
            'name' => \Yii::t('app/shop/form', 'name'),
            'amount' => \Yii::t('app/shop/form', 'amount'),
        ];
    }

    public function rules()
    {
        return [
            [['name', 'id'], 'required'],
            ['amount', 'integer'],
        ];
    }
}