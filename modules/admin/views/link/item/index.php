<?php
use plugins\LayUI\components\Html;

/** @var \yii\web\View $this */
/** @var \common\models\LinkGroup[] $columnList */

?>
    <div class="text-right">
        <?= Html::linkButton("创建", ['/admin/link/item/create', 'id' => $groupId]) ?>
    </div>
<?php
$form = \plugins\LayUI\components\ActiveForm::begin();
echo \plugins\LayUI\components\Table::widget([
    'dataProvider' => $linkList,
    'sortable'     => true,
    'orderInput'   => 'input',
    'columns'      => [
        [
            'label'   => '',
            'options' => [
                'style' => 'width: 10px;',
            ],
            'value'   => function ($data) {
                return Html::icon("arrows", ['drag-handle']);
            },
        ],
        [
            'key'   => 'type',
            'value' => function ($data) {
                $typeList = \common\models\LinkGroup::getTypeList();

                return $typeList[$data->type];
            },
        ],
        'title',
        'alias',
        'image',
        'value',
        [
            'key'     => 'order',
            'options' => [
                'style' => 'width: 80px;',
            ],
            'value'   => function ($data) {
                $orderAttr = [
                    'data-old'     => $data->order,
                    'data-id'      => $data->primaryKey,
                    'name'         => sprintf("order[%d]", $data->primaryKey),
                    'autocomplete' => 'off',
                ];

                return Html::activeTextInput($data, "order", $orderAttr);
            },
        ],
        [
            'label' => 'OPT',
            'value' => function ($data) {
                $class  = ['class' => 'layui-btn layui-btn-small layui-btn-primary'];
                $edit   = Html::a("EDIT", ['/admin/link/item/update', 'id' => $data->primaryKey], $class);
                $delete = Html::a("DELETE", ['/admin/link/item/delete', 'id' => $data->primaryKey], $class);

                return Html::buttonGroup([$edit, $delete]);
            },
        ],
    ],
]);

echo Html::submitButton();

\plugins\LayUI\components\ActiveForm::end();

