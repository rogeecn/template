<?php

use LayUI\components\ActiveForm;
use LayUI\components\Html;
use modules\article\models\Article;

/* @var $this yii\web\View */
/* @var $model Article */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, "type")->label(false)->hiddenInput() ?>
<?= $form->field($model, "title")->textInput() ?>
<?= Html::submitWrapper(Html::submitButton()) ?>
<?php ActiveForm::end() ?>
