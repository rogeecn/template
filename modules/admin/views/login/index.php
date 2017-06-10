<?php
/* @var $this yii\web\View */
/* @var $model \common\models\AdminLoginForm */

use common\extend\BSHtml;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
<?= $form->field($model, 'password')->passwordInput() ?>
<?= $form->field($model, 'rememberMe')->label("")->checkbox(['title' => 'Remember Me']) ?>
<?= BSHtml::submitButton(); ?>
<?php ActiveForm::end(); ?>
