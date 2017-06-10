<?php
use common\extend\BSHtml;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>
<?php $form = ActiveForm::begin(['action' => Url::to(['/admin/backup/config/import'])]); ?>

<?= BSHtml::textarea("config", "", ['rows' => 10, 'placeholder' => '粘贴配置文件内容']) ?>
<div style="margin-top: 20px;">
    <?= BSHtml::submitButton("提交") ?>
</div>
<?php ActiveForm::end(); ?>

