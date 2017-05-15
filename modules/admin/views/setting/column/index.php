<?php
use plugins\LayUI\components\Html;
use common\models\Setting;

/** @var \yii\web\View $this */
/** @var \common\models\Setting[] $columnList */


/** @var \yii\web\View $this */
/** @var \common\models\Setting[] $groupList */


?>
<div class="text-right">
    <?=Html::linkButton("创建",['/admin/setting/column/create','id'=>$groupId])?>
</div>
<?php
$form = \plugins\LayUI\components\ActiveForm::begin();
echo \plugins\LayUI\components\Table::widget([
    'dataProvider' => $columnList,
    'sortable'=>true,
    'orderInput'=>'input',
    'columns'      => [
        [
            'label'=>'',
            'options'=>[
                'style'=>'width: 10px;',
            ],
            'value'=>function($data){
                return Html::icon("arrows",['drag-handle']);
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
                $edit   = Html::a("EDIT", ['/admin/setting/column/update', 'id' => $data->primaryKey], $class);
                $delete = Html::a("DELETE", ['/admin/setting/column/delete', 'id' => $data->primaryKey], $class);
                return Html::buttonGroup([$edit, $delete]);
            },
        ],
    ],
]);

echo Html::submitButton();

\plugins\LayUI\components\ActiveForm::end();

