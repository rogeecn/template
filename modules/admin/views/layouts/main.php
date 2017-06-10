<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

\modules\admin\assets\AppAssets::register($this);
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
<body style="padding: 10px 0">
<?php $this->beginBody() ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <?= $content ?>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
