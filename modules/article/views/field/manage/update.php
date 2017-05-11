<?php

use LayUI\components\ActiveForm;
use LayUI\components\Html;

/* @var $this yii\web\View */
/* @var $allFields array */
/* @var $typeFields array */

$tableList = \modules\article\models\ArticleField::getTableList();
?>
<?php $form = ActiveForm::begin() ?>
<table class="layui-table">
    <colgroup>
        <col width="10%">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th class="text-right">Class</th>
        <td><?= $fieldData['class'] ?></td>
    </tr>
    <tr>
        <th class="text-right">Label</th>
        <td><?= Html::textInput("info[label]", $fieldData['label']) ?></td>
    </tr>
    <tr>
        <th class="text-right">Name</th>
        <td><?= Html::textInput("info[name]", $fieldData['name']) ?></td>
    </tr>
    <tr>
        <th class="text-right">Description</th>
        <td><?= Html::textarea('info[description]', $fieldData['description']) ?></td>
    </tr>
    <tr>
        <th class="text-right">Table</th>
        <td><?= Html::dropDownList("info[table]", $fieldData['table'], $tableList, ['prompt' => '请选择绑定表']) ?></td>
    </tr>
    <tr>
        <th class="text-right">Options</th>
        <td>
            <?php
            $fieldData['options'] = json_decode($fieldData['options'], true);
            foreach ($fieldConfig['options'] as $option) {
                echo Html::beginTag("div", ['style' => 'margin-bottom: 20px;']);
                $inputType = $option['type'];

                if (isset($fieldData['options'][$option['name']])){
                    $fieldValue = $fieldData['options'][$option['name']];
                }else{
                    $fieldValue = $option['value'];
                }
                $fieldName  = sprintf("info[options][%s]", $option['name']);
                switch ($inputType) {
                    case "checkbox":
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

