<?php
use common\extend\BSHtml;
use common\extend\Table;
use yii\bootstrap\ActiveForm;

/** @var \yii\web\View $this */
/** @var \common\models\Setting[] $groupList */
?>

    <div class="text-right">
        <?= BSHtml::buttonLink("创建", ['/admin/setting/group/create']) ?>
    </div>
<?php
$form = ActiveForm::begin();
echo Table::widget([
    'dataProvider' => $groupList,
    'sortable'     => true,
    'orderInput'   => 'input',
    'colGroup'     => [20, 0, 0, 80, 80, 160],
    'columns'      => [
        [
            'label' => '',
            'value' => function ($data) {
                return BSHtml::dragIcon();
            },
        ],
        'title',
        'alias',
        [
            'key'   => 'order',
            'value' => function ($data) {
                $orderAttr = [
                    'data-old'     => $data->order,
                    'data-id'      => $data->primaryKey,
                    'autocomplete' => 'off',
                    'name'         => sprintf("order[%d]", $data->primaryKey),
                ];

                return BSHtml::activeTextInput($data, "order", $orderAttr);
            },
        ],
        [
            'label' => 'Column',
            'value' => function ($data) {
                $column = BSHtml::a("字段管理", ['/admin/setting/column', 'group' => $data->primaryKey]);

                return $column;
            },
        ],
        [
            'label' => 'OPT',
            'value' => function ($data) {
                $edit   = BSHtml::buttonLink("EDIT", ['/admin/setting/group/update', 'id' => $data->primaryKey]);
                $delete = BSHtml::buttonLink("DELETE", ['/admin/setting/group/delete', 'id' => $data->primaryKey]);

                return BSHtml::buttonGroup([$edit, $delete]);
            },
        ],
    ],
]);

echo BSHtml::submitButton();

ActiveForm::end();
