<?php

use LayUI\components\ActiveForm;
use LayUI\components\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleType */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'description')->textarea() ?>
<?= Html::submitWrapper(Html::submitButton()) ?>

<?php ActiveForm::end(); ?>

