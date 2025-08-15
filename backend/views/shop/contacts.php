<?php

use yii\grid\GridView;
use \yii\helpers\Html;
use \yii\helpers\Url;

$createContactLink = \yii\helpers\Url::to(['shop/editcontact', 'id' => 0]);
$contactLinkName = Yii::t('app/shop/contact', 'contactLinkName');

?>

    <div class="row">
        <div class="col">
            <a href="<?= $createContactLink ?>" class="btn btn-primary"><?= $contactLinkName ?></a>
        </div>
    </div>

<?php

$contact = new \backend\models\contact\Contact();

echo GridView::widget([
    'dataProvider' => $contactsDataProvider,
    'columns' => [
        'firstname' => [
            'attribute' => 'firstname',
            'label' => $contact->getAttributeLabel('firstname'),
        ],
        'lastname' => [
            'attribute' => 'lastname',
            'label' => $contact->getAttributeLabel('lastname'),
        ],
        'actions' => [
            'attribute' => 'actions',
            'label' => $contact->getAttributeLabel('actions'),
            'format' => 'raw',
            'value' => function ($model) {
                $editButton = Html::a(
                    Html::tag('i', '', ['class' => 'fa fa-cog']),
                    Url::to(['shop/editcontact', 'id' => $model['id']]),
                );
                $deleteButton = Html::a(
                    Html::tag('i', '', ['class' => 'fa fa-trash']),
                    Url::to(['shop/deletecontact', 'id' => $model['id']]),
                );

                return $editButton . '&nbsp;&nbsp;' . $deleteButton;
            }
        ]
    ]
]);

?>