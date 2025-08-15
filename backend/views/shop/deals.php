<?php

use yii\grid\GridView;
use \yii\helpers\Html;
use \yii\helpers\Url;

$createDealLink = \yii\helpers\Url::to(['shop/editdeal', 'id' => 0]);
$dealLinkName = Yii::t('app/shop/deal', 'dealLinkName');

?>

    <div class="row">
        <div class="col">
            <a href="<?= $createDealLink ?>" class="btn btn-primary"><?= $dealLinkName ?></a>
        </div>
    </div>

<?php

$deal = new \backend\models\deal\Deal();
echo GridView::widget([
    'dataProvider' => $dealsDataProvider,
    'columns' => [
        'contactName' => [
            'attribute' => 'contactName',
            'label' => $deal->getAttributeLabel('contactName'),
        ],
        'contractName' => [
            'attribute' => 'contractName',
            'label' => $deal->getAttributeLabel('contractName'),
        ],
        'actions' => [
            'attribute' => 'actions',
            'label' => $deal->getAttributeLabel('actions'),
            'format' => 'raw',
            'value' => function ($model) {
                $editButton = Html::a(
                    Html::tag('i', '', ['class' => 'fa fa-cog']),
                    Url::to(['shop/editdeal', 'id' => $model['id']]),
                );
                $deleteButton = Html::a(
                    Html::tag('i', '', ['class' => 'fa fa-trash']),
                    Url::to(['shop/deletedeal', 'id' => $model['id']]),
                );

                return $editButton . '&nbsp;&nbsp;' . $deleteButton;
            }
        ]
    ]
]);

?>