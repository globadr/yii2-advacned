<?php

namespace backend\models\deal;

class Form extends \yii\base\Model
{
    public $id;
    public $contact;
    public $contract;

    public function attributeLabels()
    {
        return [
            'contact' => \Yii::t('app/shop/form', 'contact'),
            'contract' => \Yii::t('app/shop/form', 'contract'),
        ];
    }

    public function rules()
    {
        return [
            ['id', 'required'],
            ['id', 'integer'],
            ['contact', 'required'],
            ['contact', 'integer'],
            ['contract', 'required'],
            ['contract', 'integer'],
        ];
    }
}