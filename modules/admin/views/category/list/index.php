<?php
use common\extend\BSHtml;
use common\extend\Table;
use yii\bootstrap\ActiveForm;

ActiveForm::begin();
$submitBtn = BSHtml::submitButton();
$createBtn = BSHtml::buttonLink('创建根分类', ['/admin/category/control/create', 'id' => 0], ['icon' => 'plus']);

$btnGroup = BSHtml::buttonGroup([$submitBtn, $createBtn]);
echo BSHtml::div($btnGroup, ['class' => 'text-right', 'style' => 'margin-bottom: 20px;']);

echo Table::widget([
    'dataProvider' => $dataList,
    'sortable'     => true,
    'orderInput'   => 'input',
    'columns'      => [
        [
            'label'   => '',
            'options' => [
                'style' => 'width: 10px;',
            ],
            'value'   => function ($data) {
                return BSHtml::icon("arrows", "", ['class' => 'drag-handle']);
            },
        ],
        'id',
        'pid',
        'name',
        'alias',
        [
            'key'     => 'order',
            'options' => [
                'style' => 'width: 80px;',
            ],
            'value'   => function ($data) {
                $name      = sprintf("order[%d]", $data['id']);
                $orderAttr = [
                    'data-old'     => $data['order'],
                    'data-id'      => $data['id'],
                    'autocomplete' => 'off',
                    'name'         => sprintf("order[%d]", $data['id']),
                ];

                return BSHtml::textInput($name, $data['order'], $orderAttr);
            },
        ],
        [
            'label'   => '',
            'options' => [
                'style' => 'width:130px',
            ],
            'value'   => function ($data) {
                $edit = BSHtml::buttonLink("", ['/admin/category/control/update', 'id' => $data['id']], [
                    'icon'  => 'edit',
                    'class' => 'btn-sm',
                ]);

                $create = BSHtml::buttonLink("", ['/admin/category/control/create', 'id' => $data['id']], [
                    'icon'  => 'plus',
                    'class' => 'btn-sm',
                ]);

                $delete = BSHtml::buttonLink("", ['/admin/category/control/delete', 'id' => $data['id']], [
                    'onclick' => 'return confirm("确认删除么,分类及子分类都会被同时删除？")',
                    'icon'    => 'close',
                    'class'   => 'btn-danger btn-sm',
                ]);

                return BSHtml::buttonGroup([$edit, $create, $delete]);
            },
        ],
    ],
]);
ActiveForm::end();
