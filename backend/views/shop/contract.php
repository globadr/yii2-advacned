<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'contract-form',
    'options' => ['class' => 'form-horizontal'],
]);

echo $form->field($modelForm, 'id')->hiddenInput(['value' => $contractId])->label(false)->error(false);
echo $form->field($modelForm, 'name')->textInput();
echo $form->field($modelForm, 'amount')->textInput();

$contractModel = new \backend\models\contract\Contract();
$contractsLinkName = $contractModel->getAttributeLabel('contractFormSaveButtonName');

?>

<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton($contractsLinkName, ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
