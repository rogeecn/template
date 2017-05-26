<?php

/* @var $this \common\extend\View */
/* @var $content string */

use application\assets\AppAsset;
use common\extend\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?= $this->render("_header") ?>

<section class="container">
    <?= $content ?>
</section>
<?= \widgets\ColumnShow::widget([
    'title' => 'themebetter 国内更好的WordPress主题服务商',
    'link'  => [
        'label' => '立即前往',
        'url'   => '/gogogo',
    ],
    'style' => 'gray',
]) ?>

<footer class="footer">
    <div class="container text-center">
        <p>
            <span>© <?= date("Y") ?></span>&nbsp;
            <?= Html::a($this->setting("site.name"), $this->setting("site.url")) ?>&nbsp;
            <?= $this->ICPNumber() ?>&nbsp;
            <?= $this->PoliceNumber() ?>
        </p>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
