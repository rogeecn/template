<?php

use common\extend\BSHtml;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $allFields array */
/* @var $typeFields array */

$tableList = \common\models\ArticleField::getTableList();
?>
<?php $form = ActiveForm::begin() ?>
<table class="table table-bordered table-stripped">
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
        <td>
            <?php
            if (empty($fieldConfig['labels'])) {
                $value     = isset($fieldData['label'][$fieldConfig['name']]) ? $fieldData['label'][$fieldConfig['name']] : "";
                $labelName = sprintf("info[label][%s]", $fieldConfig['name']);
                $input     = BSHtml::textInput($labelName, $value);
                echo BSHtml::formItem(BSHtml::label($fieldConfig['description']) . $input);
            }

            foreach ($fieldConfig['labels'] as $label) {
                $value     = isset($labelData[$label['name']]) ? $labelData[$label['name']] : $label['default'];
                $labelName = sprintf("info[label][%s]", $label['name']);
                $input     = BSHtml::textInput($labelName, $value);
                echo BSHtml::formItem(BSHtml::label($label['title']) . $input);
            }
            ?>
        </td>
    </tr>
    <tr>
        <th class="text-right">Name</th>
        <td><?= BSHtml::textInput("info[name]", $fieldData['name']) ?></td>
    </tr>
    <tr>
        <th class="text-right">Description</th>
        <td><?= BSHtml::textarea('info[description]', $fieldData['description']) ?></td>
    </tr>
    <tr>
        <th class="text-right">Table</th>
        <td><?= BSHtml::dropDownList("info[table]", $fieldData['table'], $tableList, ['prompt' => '请选择绑定表']) ?></td>
    </tr>
    <tr>
        <th class="text-right">Options</th>
        <td>
            <?php
//            $fieldData['options'] = json_decode($fieldData['options'], true);
            foreach ($fieldConfig['options'] as $option) {
                $inputType = $option['type'];

                if (isset($fieldData['options'][$option['name']])) {
                    $fieldValue = $fieldData['options'][$option['name']];
                } else {
                    $fieldValue = $option['value'];
                }

                $label = "";
                if (isset($option['label'])) {
                    $label = $option['label'];
                }
                $fieldName   = sprintf("info[options][%s]", $option['name']);
                $formElement = BSHtml::createFormElement($inputType, $label, $fieldName, $fieldValue, $option['config']);
                echo BSHtml::formItem($formElement);
            }
            ?>
        </td>
    </tr>
    <tr>
        <th class="text-right">&nbsp;</th>
        <td><?= BSHtml::submitButton() ?></td>
    </tr>
    </tbody>
</table>

<?php ActiveForm::end(); ?>

