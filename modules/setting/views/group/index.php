<?php
use yii\bootstrap\Html;

/** @var \yii\web\View $this */
/** @var \modules\setting\models\Setting[] $groupList */
\yii\bootstrap\BootstrapThemeAsset::register($this);
?>

<?php $form = \yii\bootstrap\ActiveForm::begin()?>
<div class="panel panel-default">
    <div class="panel-heading text-right">
        <a href="/setting/group/create">CREATE</a>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Title</th>
            <th>Alias</th>
            <th>Order</th>
            <th>OPT</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($groupList as $item):
            $orderAttr = [
                'data-old' => $item->order,
                'data-id'  => $item->primaryKey,
                'class'    => 'form-control input-sm',
                'name'     => sprintf("order[%d]", $item->primaryKey),
            ];
            ?>

            <tr>
                <td><?= $item->title ?></td>
                <td><?= $item->alias ?></td>
                <td><?= Html::activeTextInput($item, "order", $orderAttr); ?></td>
                <td>
                    <a href="<?= \yii\helpers\Url::to(['/setting/group/update', 'id' => $item->primaryKey]) ?>">[EDIT]</a>
                    <a href="<?= \yii\helpers\Url::to(['/setting/group/delete', 'id' => $item->primaryKey]) ?>">[DELETE]</a>
                </td>
            </tr>
        <?php endforeach;; ?>
        </tbody>
    </table>
    <div class="panel-footer text-right">
        <?= Html::submitButton("SUBMIT", ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php \yii\bootstrap\ActiveForm::end();?>
