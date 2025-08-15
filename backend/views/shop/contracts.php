<?php

use yii\grid\GridView;
use \yii\helpers\Html;
use \yii\helpers\Url;

$createContractLink = \yii\helpers\Url::to(['shop/editcontract', 'id' => 0]);
$contractLinkName = Yii::t('app/shop/contract', 'contractLinkName');

?>

    <div class="row">
        <div class="col">
            <a href="<?= $createContractLink ?>" class="btn btn-primary"><?= $contractLinkName ?></a>
        </div>
    </div>

<?php

$contract = new \backend\models\contract\Contract();

echo GridView::widget([
    'dataProvider' => $contractsDataProvider,
    'columns' => [
        'name' => [
                'attribute' => 'name',
            'label' => $contract->getAttributeLabel('name'),
        ],
        'amount' => [
            'attribute' => 'amount',
            'label' => $contract->getAttributeLabel('amount'),
        ],
        'actions' => [
            'attribute' => 'actions',
            'label' => $contract->getAttributeLabel('actions'),
            'format' => 'raw',
            'value' => function ($model) {
                $editButton = Html::a(
                    Html::tag('i', '', ['class' => 'fa fa-cog']),
                    Url::to(['shop/editcontract', 'id' => $model['id']]),
                );
                $deleteButton = Html::a(
                    Html::tag('i', '', ['class' => 'fa fa-trash']),
                    Url::to(['shop/deletecontract', 'id' => $model['id']]),
                );

                return $editButton . '&nbsp;&nbsp;' . $deleteButton;
            }
        ]
    ]
]);

?>