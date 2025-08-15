<?php

/** @var yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody();

$link = $this->params['link'];

$contactModel = new \backend\models\contact\Contact;
$contactsLinkName = $contactModel->getAttributeLabel('contactsLinkName');
$contactsLinkClass = ($link === 'contacts' ? 'btn-primary' : 'btn-secondary');
$contactsLink = \yii\helpers\Url::to(['shop/contacts']);

$dealwModel = new \backend\models\deal\Deal;
$dealsLinkName = $dealwModel->getAttributeLabel('dealsLinkName');
$dealsLinkClass = ($link === 'deals' ? 'btn-primary' : 'btn-secondary');
$dealsLink = \yii\helpers\Url::to(['shop/deals']);

$contractModel = new \backend\models\contract\Contract;
$contractsLinkName = $contractModel->getAttributeLabel('contractsLinkName');
$contractsLinkClass = ($link === 'contracts' ? 'btn-primary' : 'btn-secondary');
$contractsLink = \yii\helpers\Url::to(['shop/contracts']);

?>

<main role="main">
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="<?= $contactsLink ?>" class="btn <?= $contactsLinkClass ?>">
                    <?= $contactsLinkName ?>
                </a>
            </div>
            <div class="col">
                <a href="<?= $dealsLink ?>" class="btn <?= $dealsLinkClass ?>">
                    <?= $dealsLinkName ?>
                </a>
            </div>
            <div class="col">
                <a href="<?= $contractsLink ?>" class="btn <?= $contractsLinkClass ?>">
                    <?= $contractsLinkName ?>
                </a>
            </div>
        </div>

        <?= $content ?>
    </div>
</main>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
