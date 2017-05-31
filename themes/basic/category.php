<?php

/** @var $this \common\extend\View */
/** @var $categoryChildren \common\models\Category[] */

$categoryList = array_chunk($categoryChildren, 3);
?>
<?= \widgets\Breadcrumbs::widget(['categoryID' => $categoryID]) ?>

<div class="content">
    <?php foreach ($categoryChildren as $categoryChild): ?>
        <?= \widgets\CategoryBox::widget(['categoryAlias' => $categoryChild->alias]) ?>
    <?php endforeach; ?>
</div>
<?= $this->render("sider") ?>
