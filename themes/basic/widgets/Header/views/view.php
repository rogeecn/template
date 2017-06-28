<?php
use common\extend\Html;

?>
<?= Html::beginTag("header", $options) ?>
<?= Html::beginTag("div", $containerOptions) ?>
<?= Html::div($subNav, $subNavContainerOptions) ?>
<?= Html::beginTag("div", $mainNavContainerOptions) ?>
<h1 class="logo">
    <a href="<?= \yii\helpers\Url::to($logo['url']) ?>">
        <?php
        if (isset($logo['image'])) {
            echo Html::img($logo['image'], ['alt' => $logo['title']]);
        }
        ?>
        <?= $logo['title'] ?>
    </a>
</h1>
<div class="brand"><?= $brand[0] ?><br><?= $brand[1] ?></div>
<?= $mainNav ?>
<?= Html::endTag("div") ?>
<?= Html::endTag("div") ?>
<?= Html::endTag("header") ?>
