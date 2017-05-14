<?php
use LayUI\components\ActiveForm;
use LayUI\components\Html;
/** @var \yii\web\View $this */
/** @var \common\models\Setting $model */
?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->errorSummary($model) ?>

<?= $form->field($model, "title")->textInput() ?>
<?= $form->field($model, "alias")->textInput() ?>

<?= Html::submitWrapper(Html::submitButton())?>
<?php ActiveForm::end() ?>
