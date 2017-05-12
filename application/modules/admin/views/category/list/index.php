<?php
use LayUI\components\ActiveForm;
use LayUI\components\Html;

ActiveForm::begin();
echo Html::tag("div", Html::submitButton(), ['style' => 'text-align:right;margin-bottom: 20px;']);
echo \LayUI\components\Table::widget([
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
                return Html::icon("&#xe649;", ['class' => 'drag-handle']);
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
                'style' => 'width: 20px;',
            ],
            'value'   => function ($data) {
                return Html::a(Html::icon("&#xe642;"), ['/admin/category/control/update', 'id' => $data['id']]);
            },
        ],
    ],
]);
ActiveForm::end();
