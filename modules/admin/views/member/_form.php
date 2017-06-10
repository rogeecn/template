<?php

use common\extend\BSHtml;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\User */
/* @var $form yii\widgets\ActiveForm */
$roleList   = \common\models\MemberRole::getList();
$statusList = \common\User::getStatusList();
?>


<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'email')->textInput() ?>
<?= $form->field($model, 'username')->textInput() ?>
<?= $form->field($model, 'password')->textInput() ?>
<?= $form->field($model, 'role')->dropDownList($roleList) ?>
<?= $form->field($model, 'status')->dropDownList($statusList) ?>
<?= BSHtml::submitButton(); ?>

<?php ActiveForm::end(); ?>

