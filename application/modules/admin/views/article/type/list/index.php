<?php
use LayUI\components\Html;

/** @var array $types */
/** @var \yii\web\View $this */

\LayUI\LayUIAssets::register($this);

$titleStyle = ['style' => 'font-size: 18px;color: #01aaed;display:block'];
?>
<?php if (empty($typeList)):?>
    <blockquote class="layui-elem-quote" style="margin-top: 20px;">
        <p>还没有设置文章类型</p>
    </blockquote>
<?php endif;?>

<?php foreach ($typeList as $typeInfo): ?>
    <blockquote class="layui-elem-quote" style="margin-top: 20px;">
        <h1><?= Html::a($typeInfo['name'], ['/admin/article/create', 'type' => $typeInfo['id']], $titleStyle) ?></h1>
        <hr>
        <p><?= $typeInfo['description'] ?></p>
    </blockquote>
<?php endforeach; ?>
