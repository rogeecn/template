<?php

use common\extend\BSHtml;
use common\extend\Table;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $allFields array */
/* @var $typeFields array */
?>
<?php $form = ActiveForm::begin() ?>
<div class="text-right" style="margin-bottom: 20px;">
    <?php
    $submitBtn       = BSHtml::submitButton();
    $createColumnBtn = BSHtml::buttonLink("添加字段", ['/admin/article/field/attach', 'type' => $type]);
    echo BSHtml::buttonGroup([$submitBtn, $createColumnBtn]);
    ?>
</div>

<?= Table::widget([
    'dataProvider' => $typeFields,
    'sortable'     => true,
    'orderInput'   => 'input',
    'columns'      => [
        [
            'label'   => '',
            'options' => [
                'style' => 'width: 10px;',
            ],
            'value'   => function ($data) {
                return BSHtml::dragIcon();
            },
        ],
        [
            'label' => "Label",
            'value' => function ($data) {
                $html = "";
                foreach ($data['label'] as $key => $value) {
                    $content = sprintf("%s: %s", $key, $value);
                    $html .= BSHtml::div($content);
                }

                return $html;
            },
        ],
        "name",
        "table",
        "description",
        [
            'label' => "Options",
            'value' => function ($data) {
                $html = "";

                foreach ($data['options'] as $key => $value) {
                    $content = sprintf("%s: %s", $key, $value);
                    $html .= BSHtml::div($content);
                }

                return $html;
            },
        ],
        [
            'key'     => 'order',
            'options' => [
                'style' => 'width: 80px;',
            ],
            'value'   => function ($data) {
                $orderAttr = [
                    'data-old'     => $data['order'],
                    'data-id'      => $data['id'],
                    'name'         => sprintf("order[%d]", $data['id']),
                    'autocomplete' => 'off',
                ];

                return BSHtml::textInput($orderAttr['name'], $data['order'], $orderAttr);
            },
        ],
        [
            'value' => function ($data) {
                $editBtn   = BSHtml::a("[编辑] ", ["/admin/article/field/manage/update", 'id' => $data['id']]);
                $deleteBtn = BSHtml::a("[删除]", ["/admin/article/field/manage/delete", 'id' => $data['id']]);

                return $editBtn . $deleteBtn;
            },
        ],
    ],
])
?>
<?php ActiveForm::end() ?>
