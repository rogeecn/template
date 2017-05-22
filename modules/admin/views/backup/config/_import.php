<?php
use plugins\LayUI\components\ActiveForm;
use plugins\LayUI\components\Html;
use yii\helpers\Url;

?>
<?php $form = ActiveForm::begin(['action' => Url::to(['/admin/backup/config/import'])]); ?>

<?= Html::textarea("config", "", ['rows' => 10,'placeholder'=>'粘贴配置文件内容']) ?>
<div style="margin-top: 20px;">
    <?= Html::submitButton("提交") ?>
</div>
<?php ActiveForm::end(); ?>

