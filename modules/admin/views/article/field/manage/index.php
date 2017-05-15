<?php

use plugins\LayUI\components\ActiveForm;
use plugins\LayUI\components\Html;
use common\models\Article;
use common\models\Category;

/* @var $this yii\web\View */
/* @var $allFields array */
/* @var $typeFields array */
?>
<?php $form = ActiveForm::begin()?>
<div class="text-right">
    <?=Html::submitButton()?>
    <?=Html::linkButton("添加字段",['/admin/article/field/attach','type'=>$type])?>
</div>

<?=\plugins\LayUI\components\Table::widget([
    'dataProvider'=>$typeFields,
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
        "label",
        "name",
        "table",
        "description",
        "options",
        [
            'key'   => 'order',
            'options'=>[
                'style'=>'width: 80px;',
            ],
            'value' => function ($data) {
                $orderAttr = [
                    'data-old'     => $data['order'],
                    'data-id'      => $data['id'],
                    'name'         => sprintf("order[%d]", $data['id']),
                    'autocomplete' => 'off',
                ];
                return Html::textInput($orderAttr['name'], $data['order'],$orderAttr);
            },
        ],
        [
            'value'=>function($data){
               $editBtn =  Html::a("[编辑] ",["/admin/article/field/manage/update",'id'=>$data['id']]);
                $deleteBtn = Html::a("[删除]",["/admin/article/field/manage/delete",'id'=>$data['id']]);
                return $editBtn.$deleteBtn;
            }
        ],
    ]
])
?>
<?php ActiveForm::end()?>
