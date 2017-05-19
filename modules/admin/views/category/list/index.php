<?php
use plugins\LayUI\components\ActiveForm;
use plugins\LayUI\components\Html;

ActiveForm::begin();
$submitBtn = Html::submitButton();
$createBtn = Html::a(Html::icon("plus") . '&nbsp;创建根分类', ['/admin/category/control/create', 'id' => 0], ['class' => 'layui-btn']);


echo Html::tag("div", $submitBtn . $createBtn, ['style' => 'text-align:right;margin-bottom: 20px;']);
echo \plugins\LayUI\components\Table::widget([
    'dataProvider' => $dataList,
    'sortable'     => TRUE,
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

                return Html::textInput($name, $data['order'], $orderAttr);
            },
        ],
        [
            'label'   => '',
            'options' => [
                'style' => 'width: 45px;',
            ],
            'value'   => function ($data) {
                $edit   = Html::a(Html::icon("edit", [], ['style' => 'margin-right: 10px;']), ['/admin/category/control/update', 'id' => $data['id']]);
                $create = Html::a(Html::icon("plus", [], ['style' => 'margin-right: 10px;']), ['/admin/category/control/create', 'id' => $data['id']]);

                return $edit . $create;
            },
        ],
        [
            'label'   => '',
            'options' => [
                'style' => 'width: 10px;',
            ],
            'value'   => function ($data) {
                $delete = Html::a(Html::icon("close"), ['/admin/category/control/delete', 'id' => $data['id']], [
                    'onclick' => 'return confirm("确认删除么,分类及子分类都会被同时删除？")',
                    'style'   => 'color: red;',
                ]);

                return $delete;
            },
        ],
    ],
]);
ActiveForm::end();
