<?php
use plugins\LayUI\components\Html;

/** @var \yii\web\View $this */
/** @var \common\models\LinkGroup[] $groupList */
?>

    <div class="text-right">
        <?= Html::linkButton("创建", ['/admin/link/group/create']) ?>
    </div>
<?php
$form = \plugins\LayUI\components\ActiveForm::begin();
echo \plugins\LayUI\components\Table::widget([
    'dataProvider' => $groupList,
    'sortable'     => true,
    'orderInput'   => 'input',
    'colGroup'     => [20, 0, 0, 60, 80, 80, 160],
    'columns'      => [
        [
            'label' => '',
            'value' => function ($data) {
                return Html::icon("arrows", ['drag-handle']);
            },
        ],
        'title',
        'alias',
        [
            'label' => 'LinkCount',
            'value' => function ($data) {
                /** @var $data \common\models\LinkGroup */
                return $data->getGroupLinkCount();
            },
        ],
        [
            'key'   => 'order',
            'value' => function ($data) {
                $orderAttr = [
                    'data-old'     => $data->order,
                    'data-id'      => $data->primaryKey,
                    'autocomplete' => 'off',
                    'name'         => sprintf("order[%d]", $data->primaryKey),
                ];

                return Html::activeTextInput($data, "order", $orderAttr);
            },
        ],
        [
            'label' => 'Column',
            'value' => function ($data) {
                $class  = ['class' => 'layui-btn layui-btn-small layui-btn-primary'];
                $column = Html::a("链接管理", ['/admin/link/item', 'group' => $data->primaryKey], $class);

                return $column;
            },
        ],
        [
            'label' => 'OPT',
            'value' => function ($data) {
                $class  = ['class' => 'layui-btn layui-btn-small layui-btn-primary'];
                $edit   = Html::a("EDIT", ['/admin/link/group/update', 'id' => $data->primaryKey], $class);
                $delete = Html::a("DELETE", ['/admin/link/group/delete', 'id' => $data->primaryKey], $class);

                return Html::buttonGroup([$edit, $delete]);
            },
        ],
    ],
]);

echo Html::submitButton();

\plugins\LayUI\components\ActiveForm::end();
