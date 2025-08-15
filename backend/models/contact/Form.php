<?php

namespace backend\models\contact;

class Form extends \yii\base\Model
{
    public $id;
    public $lastname;
    public $firstname;

    public function attributeLabels()
    {
        return [
            'lastname' => \Yii::t('app/shop/form', 'lastname'),
            'firstname' => \Yii::t('app/shop/form', 'firstname'),
        ];
    }

    public function rules()
    {
        return [
            [['firstname', 'id'], 'required'],
            ['lastname', 'string'],
        ];
    }
}