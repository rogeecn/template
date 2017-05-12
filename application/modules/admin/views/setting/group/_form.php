<?php
/** @var \yii\web\View $this */
/** @var \common\models\Setting $model */
?>
<?php $form = \yii\bootstrap\ActiveForm::begin(); ?>
<?= $form->errorSummary($model) ?>

<?= $form->field($model, "title")->textInput() ?>
<?= $form->field($model, "alias")->textInput() ?>

<?= \yii\bootstrap\Html::submitButton("SUBMIT") ?>
<?php \yii\bootstrap\ActiveForm::end() ?>
