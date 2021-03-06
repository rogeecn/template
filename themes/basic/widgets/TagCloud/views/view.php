<?php
use yii\helpers\Html;

?>
<div class="widget <?= $hasBorder ? "border" : "" ?> tag-cloud">
    <h3 class="title"><?= $title ?></h3>
    <ul class="body">
        <?php foreach ($items as $tag): ?>
            <li>
                <?= Html::a($tag['label'], $tag['url']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

