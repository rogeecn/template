<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

\modules\admin\assets\EasyUIAssets::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body class="easyui-layout">
<?php $this->beginBody() ?>
<div data-options="region:'center',border:false"><?= $content ?></div>
<?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>
