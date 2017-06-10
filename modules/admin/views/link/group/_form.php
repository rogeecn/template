<?php
use common\extend\BSHtml;
use yii\bootstrap\ActiveForm;

/** @var \yii\web\View $this */
/** @var \common\models\LinkGroup $model */

$form = ActiveForm::begin();
echo $form->errorSummary($model);
echo $form->field($model, "title")->textInput();
echo $form->field($model, "alias")->textInput();
echo BSHtml::submitButton();
ActiveForm::end();
