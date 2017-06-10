<?php
use common\extend\BSHtml;
use common\extend\Table;
use yii\bootstrap\ActiveForm;

/** @var \yii\web\View $this */
/** @var \common\models\LinkGroup[] $groupList */
?>


    <div class="text-right" style="margin-bottom: 20px;">
        <?php
        $createButton = BSHtml::buttonLink("创建", ['/admin/link/group/create']);
        $submitButton = BSHtml::submitButton();

        echo BSHtml::buttonGroup([$createButton, $submitButton]);
        ?>
    </div>


<?php
$form = ActiveForm::begin();
echo Table::widget([
    'dataProvider' => $groupList,
    'sortable'     => true,
    'orderInput'   => 'input',
    'colGroup'     => [20, 0, 0, 60, 80, 80, 160],
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

                return BSHtml::activeTextInput($data, "order", $orderAttr);
            },
        ],
        [
            'label' => 'Column',
            'value' => function ($data) {
                $column = BSHtml::buttonLink("链接管理", ['/admin/link/item', 'group' => $data->primaryKey]);

                return $column;
            },
        ],
        [
            'label' => 'OPT',
            'value' => function ($data) {
                $edit   = BSHtml::buttonLink("EDIT", ['/admin/link/group/update', 'id' => $data->primaryKey]);
                $delete = BSHtml::buttonLink("DELETE", ['/admin/link/group/delete', 'id' => $data->primaryKey]);

                return BSHtml::buttonGroup([$edit, $delete]);
            },
        ],
    ],
]);
ActiveForm::end();
