<?php

namespace backend\models\contract;

use yii\base\Model;
use yii\db\Query;

class Contract extends Model
{
    public static string $tableName = 'contracts';

    public function attributeLabels()
    {
        return [
            'contractsLinkName' => \Yii::t('app/shop/contract', 'contractsLinkName'),
            'contractFormSaveButtonName' => \Yii::t('app/shop/contract', 'contractFormSaveButtonName'),
            'name' => \Yii::t('app/shop/contract', 'name'),
            'amount' => \Yii::t('app/shop/contract', 'amount'),
            'actions' => \Yii::t('app/shop/contact', 'actions'),
        ];
    }

    public static function getAll() {
        return (new Query())->from(self::$tableName);
    }

    public static function getAllForForm() {
        $sql = '
            select id, name
            from ' . static::$tableName
        ;

        $records = [];
        foreach (\Yii::$app->db->createCommand($sql)->queryAll() as $record) {
            $records[$record['id']] = $record['name'];
        };

        return $records;
    }

    public static function getOne(int $id) {
        return (new Query)->from(static::$tableName)->where(['id' => $id])->one();
    }
}