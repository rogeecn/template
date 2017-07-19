<?php

/* @var $this \common\extend\View */
/* @var $content string */

use common\widgets\Alert;
use yii\helpers\Html;

$this->setAdminMode();
\modules\admin\assets\AppAssets::register($this)
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Login</title>
    <?php $this->head() ?>
    <style>
        body {
            padding-top: 60px;
        }

        .footer{
            padding: 50px;
        }

        .navbar-inverse {
            background-color: #394754;
            border-color: #394754;
        }

        .navbar-inverse .navbar-nav > li > a {
            color: white;
        }

        .navbar-inverse .navbar-nav > .open > a,
        .navbar-inverse .navbar-nav > .open > a:hover,
        .navbar-inverse .navbar-nav > .open > a:focus {
            color: #ffffff;
            background-color: #5d6e80;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>
<?php
if (!Yii::$app->getUser()->getIsGuest()) {
    echo $this->render("menu");
}
?>
<div class="container-fluid">
    <?= Alert::widget() ?>
    <?= $content ?>
</div>

<div class="container-fluid footer">
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

