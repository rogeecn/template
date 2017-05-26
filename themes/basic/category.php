<?php
/** @var $this \common\extend\View */
?>
<?= \widgets\Breadcrumbs::widget(['categoryID' => 20]) ?>

<div class="row">
    <?php for ($i = 0; $i < 3; $i++): ?>
        <div class="box">
            <div class="widget border">
                <h2 class="title"><a href="/">你好中国</a></h2>
                <ul class="body">
                    <?php for ($k = 1; $k < 10; $k++): ?>
                        <li>
                            <time>2017-01-02</time>
                            <a href="/">你你好中国333你好中国333好中国333</a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
    <?php endfor; ?>
</div>

