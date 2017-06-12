<?php
/* @var $this yii\web\View */
/* @var $model \common\models\AdminLoginForm */

use common\extend\BSHtml;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<style>
    body{
        background: url("http://img2.bdstatic.com/static/pcphotographer/img/img_gridback_bc4e079.png");
    }
</style>

<div class="row">
    <div class="col-xs-6 col-xs-offset-3">
        <?php $form = ActiveForm::begin(); ?>
        <div class="panel panel-default" style="margin-top: 20%;">
            <div class="panel-heading text-center">
                <h3>Login</h3>
            </div>
            <div class="panel-body">
                <?= $form->field($model, 'username')->textInput(['autofocus' => TRUE]) ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
            </div>
            <div class="panel-footer">
                <?= BSHtml::submitButton("登录",['class'=>'btn-block']); ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
