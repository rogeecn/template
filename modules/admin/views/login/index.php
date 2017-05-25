<?php

/* @var $this yii\web\View */
/* @var $model \common\models\AdminLoginForm */

use plugins\LayUI\components\ActiveForm;
use plugins\LayUI\components\Html;

$this->title = 'Login';
?>

<style>
    .layui-form-item .layui-input-inline {
        width: auto;
    }
</style>
<div id="form" style="width: 600px; margin: 0 auto; margin-top: 10%;">
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    <?= $form->field($model, 'username')->textInput(['autofocus' => TRUE]) ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'rememberMe')->label("")->checkbox(['title' => 'Remember Me']) ?>
    <?= Html::submitWrapper(Html::submitButton()); ?>
    <?php ActiveForm::end(); ?>
</div>
