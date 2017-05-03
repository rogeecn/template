<?php
/** @var \yii\web\View $this */
/** @var \modules\setting\models\Setting $model */
$typeList  = \modules\setting\models\Setting::getTypeList();
$groupList = \modules\setting\models\Setting::getGroupList(true);
?>

<?php $form = \yii\bootstrap\ActiveForm::begin(); ?>
<?= $form->errorSummary($model) ?>

<?= $form->field($model, "group_id")->dropDownList($groupList) ?>
<?= $form->field($model, "type")->dropDownList($typeList) ?>
<?= $form->field($model, "title")->textInput() ?>
<?= $form->field($model, "alias")->textInput() ?>
<?= $form->field($model, "hint")->textInput() ?>
<?= $form->field($model, "pre_configure")->textarea() ?>

<?= \yii\bootstrap\Html::submitButton("SUBMIT") ?>
<?php \yii\bootstrap\ActiveForm::end() ?>
