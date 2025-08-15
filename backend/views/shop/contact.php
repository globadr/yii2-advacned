<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'contact-form',
    'options' => ['class' => 'form-horizontal'],
]);

echo $form->field($modelForm, 'id')->hiddenInput(['value' => $contactId])->label(false)->error(false);
echo $form->field($modelForm, 'firstname')->textInput();
echo $form->field($modelForm, 'lastname')->textInput();

$contactModel = new \backend\models\contact\Contact();
$contactsLinkName = $contactModel->getAttributeLabel('contactFormSaveButtonName');

?>

<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton($contactsLinkName, ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
