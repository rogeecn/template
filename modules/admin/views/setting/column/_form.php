<?php
use plugins\LayUI\components\ActiveForm;
use plugins\LayUI\components\Html;
/** @var \yii\web\View $this */
/** @var \common\models\Setting $model */
$typeList  = \common\models\Setting::getTypeList();
$groupList = \common\models\Setting::getGroupList(true);
?>

<?php $form =ActiveForm::begin(); ?>
<?= $form->errorSummary($model) ?>

<?= $form->field($model, "type")->dropDownList($typeList) ?>
<?= $form->field($model, "title")->textInput() ?>
<?= $form->field($model, "alias")->textInput() ?>
<?= $form->field($model, "hint")->textInput() ?>
<?= $form->field($model, "pre_configure")->textarea() ?>

<?= Html::submitWrapper(Html::submitButton() )?>
<?php ActiveForm::end() ?>
