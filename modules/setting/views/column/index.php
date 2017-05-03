<?php
use modules\setting\models\Setting;

/** @var \yii\web\View $this */
/** @var \modules\setting\models\Setting[] $columnList */
\yii\bootstrap\BootstrapThemeAsset::register($this);

$groupList = Setting::getGroupList(true);
$typeList  = Setting::getTypeList();
?>

<div class="panel panel-default">
    <div class="panel-heading text-right">
        <a href="/setting/column/create">CREATE</a>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Title</th>
            <th>Alias</th>
            <th>Group</th>
            <th>Hint</th>
            <th>Type</th>
            <th>PreConfigure</th>
            <th>OPT</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($columnList as $item): ?>
            <tr>
                <td><?= $item->title ?></td>
                <td><?= $item->alias ?></td>
                <td><?= $groupList[$item->group_id] ?></td>
                <td><?= $item->hint ?></td>
                <td><?= $typeList[$item->type] ?></td>
                <td><?= $item->pre_configure ?></td>
                <td>
                    <a href="<?= \yii\helpers\Url::to(['/setting/column/update', 'id' => $item->primaryKey]) ?>">[EDIT]</a>
                    <a href="<?= \yii\helpers\Url::to(['/setting/column/delete', 'id' => $item->primaryKey]) ?>">[DELETE]</a>
                </td>
            </tr>
        <?php endforeach;; ?>
        </tbody>
    </table>
</div>
