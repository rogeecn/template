<?php
use common\extend\Html;

/** @var $this \common\extend\View */
/** @var $categoryChildren \common\models\Category[] */

$categoryList = array_chunk($categoryChildren, 3);
?>
<?= \widgets\Breadcrumbs::widget(['categoryID' => $categoryID]) ?>

<?php foreach ($categoryList as $categoryChildren): ?>
    <div class="row">
        <?php foreach ($categoryChildren as $categoryChild): ?>
            <div class="box">
                <div class="widget border">
                    <h2 class="title">
                        <?= Html::a($categoryChild->name, $this->categoryURL($categoryChild->alias)) ?>
                    </h2>
                    <ul class="body">
                        <?php for ($k = 1; $k < 15; $k++): ?>
                            <li>
                                <time>2017-01-02</time>
                                <a href="/">你你好中国3333你好中国333好中国333333你好中国333好中国33333你好中国333好中国333</a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>
