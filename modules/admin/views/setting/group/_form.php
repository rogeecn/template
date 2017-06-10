<?php
use common\extend\BSHtml;
use yii\bootstrap\ActiveForm;

/** @var \yii\web\View $this */
/** @var \common\models\Setting $model */
?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->errorSummary($model) ?>

<?= $form->field($model, "title")->textInput() ?>
<?= $form->field($model, "alias")->textInput() ?>

<?= BSHtml::submitButton() ?>
<?php ActiveForm::end() ?>
