<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

//\application\assets\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body style="padding: 10px;">
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
<script>
    var element = layui.element();
    var form = layui.form();
</script>
</body>
</html>
<?php $this->endPage() ?>
