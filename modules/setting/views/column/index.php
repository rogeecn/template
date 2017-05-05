<?php
use LayUI\components\Html;
use modules\setting\models\Setting;

/** @var \yii\web\View $this */
/** @var \modules\setting\models\Setting[] $columnList */
\yii\bootstrap\BootstrapThemeAsset::register($this);


/** @var \yii\web\View $this */
/** @var \modules\setting\models\Setting[] $groupList */

$form = \LayUI\components\ActiveForm::begin();
echo \LayUI\components\Table::widget([
    'dataProvider' => $columnList,
    'sortable'=>true,
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
            'key'   => 'order',
            'options'=>[
                'style'=>'width: 80px;',
            ],
            'value' => function ($data) {
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
                $edit   = Html::a("EDIT", ['/setting/column/update', 'id' => $data->primaryKey], $class);
                $delete = Html::a("DELETE", ['/setting/column/delete', 'id' => $data->primaryKey], $class);
                return Html::buttonGroup([$edit, $delete]);
            },
        ],
    ],
]);

echo Html::submitButton();

\LayUI\components\ActiveForm::end();

