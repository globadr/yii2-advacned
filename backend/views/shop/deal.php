<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'deal-form',
    'options' => ['class' => 'form-horizontal'],
]);

echo $form->field($modelForm, 'id')->hiddenInput(['value' => $dealId])->label(false)->error(false);
echo $form->field($modelForm, 'contact')->listBox($contacts);
echo $form->field($modelForm, 'contract')->listBox($contracts);

$dealModel = new \backend\models\deal\Deal();
$dealsLinkName = $dealModel->getAttributeLabel('contractFormSaveButtonName');

?>

<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton($dealsLinkName, ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
