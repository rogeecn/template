<?php

use common\models\ArticleField;
use LayUI\components\ActiveForm;
use LayUI\components\Html;

/* @var $this yii\web\View */
/* @var $allFields array */
/* @var $typeFields array */

$tableList = ArticleField::getTableList();
?>
<?php $form = ActiveForm::begin(['action' => ["/admin/article/field/manage/create"]]) ?>
<?= Html::hiddenInput("info[class]", $class) ?>
<?= Html::hiddenInput("info[type]", \common\util\Request::input("type")) ?>
<table class="layui-table">
    <colgroup>
        <col width="10%">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th class="text-right">Class</th>
        <td><?= $class ?></td>
    </tr>
    <tr>
        <th class="text-right">Label</th>
        <td><?= Html::textInput("info[label]", "") ?></td>
    </tr>
    <tr>
        <th class="text-right">Name</th>
        <td><?= Html::textInput("info[name]", $name) ?></td>
    </tr>
    <tr>
        <th class="text-right">Description</th>
        <td><?= Html::textarea('info[description]', $description) ?></td>
    </tr>
    <tr>
        <th class="text-right">Table</th>
        <td><?= Html::dropDownList("info[table]", $table, $tableList, ['prompt' => '请选择绑定表']) ?></td>
    </tr>
    <tr>
        <th class="text-right">Options</th>
        <td>
            <?php
            foreach ($options as $option) {
                echo Html::beginTag("div", ['style' => 'margin-bottom: 20px;']);
                $inputType = $option['type'];

                $fieldValue = $option['value'];
                $fieldName  = sprintf("info[options][%s]", $option['name']);
                switch ($inputType) {
                    case "checkbox":
                        echo Html::checkbox($fieldName, $fieldValue, $option['config']);
                        break;
                    case "textInput":
                        echo Html::checkbox($fieldName, $fieldValue, $option['config']);
                        break;
                }
                echo Html::endTag("div");
            }
            ?>
        </td>
    </tr>
    <tr>
        <th class="text-right">&nbsp;</th>
        <td><?= Html::submitButton() ?></td>
    </tr>
    </tbody>
</table>

<?php ActiveForm::end(); ?>
