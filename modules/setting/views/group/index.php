<?php
/** @var \yii\web\View $this */
/** @var \modules\setting\models\Setting[] $groupList */
    \yii\bootstrap\BootstrapThemeAsset::register($this)
?>

<div class="panel panel-default">
    <div class="panel-heading text-right">
        <a href="/setting/group/create">CREATE</a>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Title</th>
            <th>Alias</th>
            <th>OPT</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($groupList as $item):?>
            <tr>
                <td><?=$item->title?></td>
                <td><?=$item->alias?></td>
                <td>
                    <a href="<?=\yii\helpers\Url::to(['/setting/group/update','id'=>$item->primaryKey])?>">[EDIT]</a>
                    <a href="<?=\yii\helpers\Url::to(['/setting/group/delete','id'=>$item->primaryKey])?>">[DELETE]</a>
                </td>
            </tr>
        <?php endforeach;;?>
        </tbody>
    </table>
</div>
