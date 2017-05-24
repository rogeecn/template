<?php

use plugins\LayUI\components\ActiveForm;
use plugins\LayUI\components\Html;

/* @var $this yii\web\View */
/* @var $model common\User */
/* @var $form yii\widgets\ActiveForm */
$roleList   = \common\models\MemberRole::getList();
$statusList = \common\models\User::getStatusList();
?>


<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'email')->textInput() ?>
<?= $form->field($model, 'username')->textInput() ?>
<?= $form->field($model, 'password')->textInput() ?>
<?= $form->field($model, 'role')->dropDownList($roleList) ?>
<?= $form->field($model, 'status')->dropDownList($statusList) ?>
<?= Html::submitWrapper(Html::submitButton()); ?>

<?php ActiveForm::end(); ?>

