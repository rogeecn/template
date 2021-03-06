<?php
use yii\helpers\Html;

?>

<?= Html::beginTag("div", $options) ?>
<ul class="tab-nav">
    <?php
    foreach ($items as $index => $item) {
        if (!isset($item['options'])) {
            $item['options'] = [];
        }

        if ($index == 0) {
            Html::addCssClass($item['options'], "active");
        }

        echo Html::tag("li", $item['title'], $item['options']);
    }
    ?>
</ul>
<ul class="tab-body">
    <?php
    foreach ($items as $index => $item) {
        if ($item instanceof \Closure) {
            echo $item();
            continue;
        }

        if (!isset($item['contentOptions'])) {
            $item['contentOptions'] = [];
        }

        if ($index == 0) {
            Html::addCssClass($item['contentOptions'], "active");
        }

        echo Html::tag("li", $item['content'], $item['contentOptions']);
    }
    ?>
</ul>
<?= Html::endTag("div") ?>
