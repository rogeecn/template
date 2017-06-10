<?php
use common\extend\BSHtml;

/** @var array $types */
/** @var \yii\web\View $this */

?>
<?php if (empty($typeList)): ?>
    <div class="alert alert-danger">
        <p>还没有设置文章类型</p>
    </div>
<?php endif; ?>

<?php foreach ($typeList as $typeInfo): ?>
    <div class="panel panel-default" style="margin-top: 20px;">
        <div class="panel-heading">
            <h3><?= BSHtml::a($typeInfo['name'], ['/admin/article/create', 'type' => $typeInfo['id']]) ?></h3>
        </div>
        <div class="panel-body">
            <?= $typeInfo['description'] ?>
        </div>
    </div>
<?php endforeach; ?>
