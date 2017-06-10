<?php
use common\extend\BSHtml;
use yii\bootstrap\ActiveForm;

/** @var \yii\web\View $this */
/** @var \common\models\LinkGroup $model */

$typeList = \common\models\LinkGroup::getTypeList();
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->errorSummary($model) ?>

<?= $form->field($model, "type")->dropDownList($typeList) ?>
<?= $form->field($model, "title")->textInput() ?>
<?= $form->field($model, "alias")->textInput() ?>
<?= $form->field($model, "image")->textInput() ?>
<?= $form->field($model, "value")->textInput() ?>

<?= BSHtml::submitButton() ?>
<?php ActiveForm::end() ?>
