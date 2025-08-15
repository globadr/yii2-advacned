<?php

namespace frontend\controllers;

use frontend\models\shop\Contact;
use frontend\models\shop\Contract;
use frontend\models\shop\Deal;
use yii\web\Controller;

class ShopController extends Controller
{
    public $layout = 'blank';

    public function actionIndex()
    {
        $contacts = Contact::find()->all();
        $contracts = Contract::find()->all();
        $deals = Deal::find()->all();

        return $this->render('index', ['contacts' => $contacts, 'contracts' => $contracts, 'deals' => $deals]);
    }
}