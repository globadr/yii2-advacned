<?php

namespace backend\models\deal;

use backend\models\contract\Contract;
use backend\models\contact\Contact;
use Yii;
use yii\base\Model;
use yii\db\Query;

class Deal extends Model
{
    public static string $tableName = 'deals';

    public function attributeLabels()
    {
        return [
            'dealsLinkName' => \Yii::t('app/shop/deal', 'dealsLinkName'),
            'contactName' => Yii::t('app/shop/deal', 'contactName'),
            'contractName' => Yii::t('app/shop/deal', 'contractName'),
            'actions' => Yii::t('app/shop/deal', 'actions'),
            'contractFormSaveButtonName' => Yii::t('app/shop/deal', 'contractFormSaveButtonName'),
        ];
    }

    public static function getAll()
    {
        $query = new Query();
        $query->from(['d' => static::$tableName])
            ->innerJoin(['c1' => Contact::$tableName], 'd.contact = c1.id')
            ->innerJoin(['c2' => Contract::$tableName], 'd.contract = c2.id')
            ->select([
                'd.id',
                'concat_ws(" ", c1.lastname, c1.firstname) as contactName',
                'c2.name as contractName'
            ]);

        return $query;
    }

    public static function getOne(int $id) {
        return (new Query)->from(static::$tableName)->where(['id' => $id])->one();
    }
}