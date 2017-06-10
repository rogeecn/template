<?php
use common\extend\BSHtml;
use common\extend\Table;
use common\models\Setting;
use yii\bootstrap\ActiveForm;

/** @var \yii\web\View $this */
/** @var \common\models\Setting[] $columnList */


/** @var \yii\web\View $this */
/** @var \common\models\Setting[] $groupList */


?>
    <div class="text-right">
        <?= BSHtml::buttonLink("创建", ['/admin/setting/column/create', 'id' => $groupId]) ?>
    </div>
<?php
$form = ActiveForm::begin();
echo Table::widget([
    'dataProvider' => $columnList,
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
            'key'   => 'group',
            'value' => function ($data) {
                $groupList = Setting::getGroupList(true);

                return $groupList[$data->group_id];
            },
        ],
        [
            'key'   => 'type',
            'value' => function ($data) {
                $typeList = Setting::getTypeList();

                return $typeList[$data->type];
            },
        ],
        'alias',
        'title',
        "hint",
        [
            'key'   => 'pre_configure',
            'label' => 'PreConfigure',
        ],
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
                $edit   = BSHtml::a("EDIT", ['/admin/setting/column/update', 'id' => $data->primaryKey]);
                $delete = BSHtml::a("DELETE", ['/admin/setting/column/delete', 'id' => $data->primaryKey]);

                return BSHtml::buttonGroup([$edit, $delete]);
            },
        ],
    ],
]);

echo BSHtml::submitButton();

ActiveForm::end();

