<?php
use LayUI\components\Html;

/** @var \yii\web\View $this */
/** @var \common\models\Setting[] $groupList */
?>

<div class="text-right">
    <?=Html::linkButton("创建",['/admin/link/group/create'])?>
</div>
<?php
$form = \LayUI\components\ActiveForm::begin();
echo \LayUI\components\Table::widget([
    'dataProvider' => $groupList,
    'sortable' => true,
    'orderInput'=>'input',
    'colGroup'=>[20,0,0,80,80,160],
    'columns'      => [
        [
            'label'=>'',
            'value'=>function($data){
                return Html::icon("&#xe649;",['class'=>'drag-handle']);
            }
        ],
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
            'label' => 'Column',
            'value' => function ($data) {
                $class  = ['class' => 'layui-btn layui-btn-small layui-btn-primary'];
                $column   = Html::a("链接管理", ['/admin/link/item', 'group' => $data->primaryKey], $class);
                return $column;
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
