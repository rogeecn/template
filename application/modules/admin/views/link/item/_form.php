<?php
use LayUI\components\ActiveForm;
use LayUI\components\Html;
/** @var \yii\web\View $this */
/** @var \common\models\Setting $model */
$typeList  = \common\models\LinkGroup::getTypeList();
?>

<?php $form =ActiveForm::begin(); ?>
<?= $form->errorSummary($model) ?>

<?= $form->field($model, "type")->dropDownList($typeList) ?>
<?= $form->field($model, "title")->textInput() ?>
<?= $form->field($model, "alias")->textInput() ?>
<?= $form->field($model, "value")->textInput() ?>

<?= Html::submitWrapper(Html::submitButton() )?>
<?php ActiveForm::end() ?>
