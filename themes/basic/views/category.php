<?php

/** @var $this \common\extend\View */
/** @var $categoryChildren \common\models\Category[] */

$categoryList = array_chunk($categoryChildren, 2);
?>
<?= \themes\basic\widgets\Breadcrumbs::widget(['categoryID' => $categoryID]) ?>

    <div class="content">
        <?php foreach ($categoryList as $categoryChildren): ?>
            <div class="row">
                <?php if (isset($categoryChildren[0])): ?>
                    <div class="col col-left">
                        <?= \themes\basic\widgets\CategoryBox::widget([
                            'categoryAlias' => $categoryChildren[0]->alias,
                        ]) ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($categoryChildren[1])): ?>
                    <div class="col col-right">
                        <?= \themes\basic\widgets\CategoryBox::widget([
                            'categoryAlias' => $categoryChildren[1]->alias,
                        ]) ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

<?= $this->render("sider") ?>