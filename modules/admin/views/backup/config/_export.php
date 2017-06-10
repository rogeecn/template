<?php
use common\extend\BSHtml;
use common\extend\Table;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>
<?php $form = ActiveForm::begin(['action' => Url::to(['/admin/backup/config/export'])]); ?>

<?= Table::widget([
    'dataProvider' => $dataList,
    'colGroup'     => [60, 100, 0],
    'columns'      => [
        [
            'value' => function ($data) {
                $name = sprintf("type[%s]", $data['name']);

                return BSHtml::checkbox($name, true);
            },
        ],
        "label",
        "description",
    ],
]) ?>
<div>
    <?= BSHtml::submitButton() ?>
</div>
<?php ActiveForm::end(); ?>

