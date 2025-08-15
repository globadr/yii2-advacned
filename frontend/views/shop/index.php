<?php

use frontend\assets\ShopAsset;
use frontend\models\shop\Contact;
use frontend\models\shop\Contract;
use frontend\models\shop\Deal;
use yii\web\View;
use yii\helpers\Json;

$contact = new Contact();
$contract = new Contract();
$deal = new Deal();

$jsParams = [
    'menuItems' => [
        $contact->getAttributeLabel('menuItemName'),
        $deal->getAttributeLabel('menuItemName')
    ],
    'contacts' => $contacts,
    'contracts' => $contracts,
    'deals' => $deals,
    'headers' => [
        'lastname' => $contact->getAttributeLabel('lastname'),
        'firstname' => $contact->getAttributeLabel('firstname'),
        'name' => $contract->getAttributeLabel('name'),
        'amount' => $contract->getAttributeLabel('amount'),
        'contactId' => $contact->getAttributeLabel('contactId'),
        'contractId' => $contract->getAttributeLabel('contractId'),
    ]
];

$this->registerJs(
    'var shopMainConfig = ' . Json::htmlEncode($jsParams) . ';',
    View::POS_HEAD,
    'appConfigGlobal'
);

ShopAsset::register($this);

?>

<div class="row">
    <div class="col shop-menu"></div>
    <div class="col shop-list"></div>
    <div class="col shop-content"></div>
</div>
