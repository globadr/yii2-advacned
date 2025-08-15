<?php

namespace backend\models\contact;

use yii\base\Model;
use yii\db\Query;

class Contact extends Model
{
    public static string $tableName = 'contacts';

    public function attributeLabels()
    {
        return [
            'contactsLinkName' => \Yii::t('app/shop/contact', 'contactsLinkName'),
            'contactFormSaveButtonName' => \Yii::t('app/shop/contact', 'contactFormSaveButtonName'),
            'lastname' => \Yii::t('app/shop/contact', 'lastname'),
            'firstname' => \Yii::t('app/shop/contact', 'firstname'),
            'actions' => \Yii::t('app/shop/contact', 'actions'),
        ];
    }

    public static function getAll() {
        return (new Query())->from(self::$tableName);
    }

    public static function getAllForForm() {
        $sql = '
            select id, concat_ws(" ", lastname, firstname) as fullname
            from ' . static::$tableName
        ;

        $records = [];
        foreach (\Yii::$app->db->createCommand($sql)->queryAll() as $record) {
            $records[$record['id']] = $record['fullname'];
        };

        return $records;
    }

    public static function getOne(int $id) {
        return (new Query)->from(static::$tableName)->where(['id' => $id])->one();
    }
}