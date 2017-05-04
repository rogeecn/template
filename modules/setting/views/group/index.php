<?php
use LayUI\components\Html;

/** @var \yii\web\View $this */
/** @var \modules\setting\models\Setting[] $groupList */

$form = \LayUI\components\ActiveForm::begin();
echo \LayUI\components\Table::widget([
    'columns'      => [
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
                return Html::activeTextInput($data, "order", $orderAttr);
            },
        ],
        [
            'label' => 'OPT',
            'value' => function ($data) {
                $class  = ['class' => 'layui-btn layui-btn-small layui-btn-primary'];
                $edit   = Html::a("EDIT", ['/setting/group/update', 'id' => $data->primaryKey], $class);
                $delete = Html::a("DELETE", ['/setting/group/delete', 'id' => $data->primaryKey], $class);
                return Html::buttonGroup([$edit, $delete]);
            },
        ],
    ],
    'dataProvider' => $groupList,
]);

echo Html::submitButton();

\LayUI\components\ActiveForm::end();
