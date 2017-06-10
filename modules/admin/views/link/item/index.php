<?php
use common\extend\BSHtml;
use common\extend\Table;
use common\models\LinkGroup;
use yii\bootstrap\ActiveForm;

/** @var \yii\web\View $this */
/** @var \common\models\LinkGroup[] $columnList */

?>
    <div class="text-right">
        <?= BSHtml::buttonLink("创建", ['/admin/link/item/create', 'id' => $groupId]) ?>
    </div>
<?php
$form = ActiveForm::begin();
echo Table::widget([
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
                return BSHtml::icon("arrows", ['drag-handle']);
            },
        ],
        [
            'key'   => 'type',
            'value' => function ($data) {
                $typeList = LinkGroup::getTypeList();

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

                return BSHtml::activeTextInput($data, "order", $orderAttr);
            },
        ],
        [
            'label' => 'OPT',
            'value' => function ($data) {
                $edit   = BSHtml::buttonLink("EDIT", ['/admin/link/item/update', 'id' => $data->primaryKey]);
                $delete = BSHtml::buttonLink("DELETE", ['/admin/link/item/delete', 'id' => $data->primaryKey]);

                return BSHtml::buttonGroup([$edit, $delete]);
            },
        ],
    ],
]);

echo BSHtml::submitButton();

ActiveForm::end();

