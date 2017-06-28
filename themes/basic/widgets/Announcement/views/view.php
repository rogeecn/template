<?php
use yii\helpers\Html;

?>
<article class="announcement">
    <h3 class="title">
        <?php
        if (!empty($category)) {
            echo Html::a(sprintf("【%s】", $category['label']), $category['url'], ['class' => 'category']);
        }
        ?>
        <?php
        if (!empty($title)) {
            echo Html::a($title['label'], $title['url']);
        }
        ?>
    </h3>
    <p class="info"><?= $content ?></p>
</article>

