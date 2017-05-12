<?php
use LayUI\components\Html;

/** @var \yii\web\View $this */
/** @var \common\models\Setting[] $groupList */

$form = \LayUI\components\ActiveForm::begin();
echo \LayUI\components\Table::widget([
    'dataProvider' => $groupList,
    'sortable' => true,
    'orderInput'=>'input',
    'columns'      => [
        [
            'label'=>'',
            'options'=>[
                'style'=>'width: 10px;',
            ],
            'value'=>function($data){
                return Html::icon("&#xe649;",['class'=>'drag-handle']);
            }
        ],
        'title',
        'alias',
        [
            'key'   => 'order',
            'options'=>[
                'style'=>'width: 80px;',
            ],
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
            'label' => 'OPT',
            'value' => function ($data) {
                $class  = ['class' => 'layui-btn layui-btn-small layui-btn-primary'];
                $edit   = Html::a("EDIT", ['/admin/setting/group/update', 'id' => $data->primaryKey], $class);
                $delete = Html::a("DELETE", ['/admin/setting/group/delete', 'id' => $data->primaryKey], $class);
                return Html::buttonGroup([$edit, $delete]);
            },
        ],
    ],
]);

echo Html::submitButton();

\LayUI\components\ActiveForm::end();
