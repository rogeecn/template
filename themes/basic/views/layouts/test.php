<?php

/* @var $this \common\extend\View */
/* @var $content string */

use themes\basic\assets\AppAsset;

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
<section class="container">
    <?= $content ?>
</section>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
