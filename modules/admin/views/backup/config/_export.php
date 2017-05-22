<?php
use plugins\LayUI\components\ActiveForm;
use plugins\LayUI\components\Html;
use yii\helpers\Url;

?>
<?php $form = ActiveForm::begin(['action' => Url::to(['/admin/backup/config/export'])]); ?>

<?= \plugins\LayUI\components\Table::widget([
    'dataProvider' => $dataList,
    'colGroup'     => [60, 100, 0],
    'columns'      => [
        [
            'value' => function ($data) {
                $name = sprintf("type[%s]", $data['name']);

                return Html::checkbox($name, TRUE, ['lay-skin' => 'layui-primary']);
            },
        ],
        "label",
        "description",
    ],
]) ?>
<div>
    <?= Html::submitButton("提交") ?>
</div>
<?php ActiveForm::end(); ?>

