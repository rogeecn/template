<?php

use common\extend\BSHtml;
use common\models\ArticleField;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $allFields array */
/* @var $typeFields array */

$tableList = ArticleField::getTableList();
?>
<?php $form = ActiveForm::begin(['action' => ["/admin/article/field/manage/create"]]) ?>
<?= BSHtml::hiddenInput("info[class]", $class) ?>
<?= BSHtml::hiddenInput("info[type]", \common\util\Request::input("type")) ?>
<table class="table table-stripped table-bordered">
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
        <td>
            <?php
            if (empty($labels)) {
                $labelName = sprintf("info[label][%s]", $name);
                $input     = BSHtml::textInput($labelName, "");
                echo BSHtml::formItem(BSHtml::label($description) . $input);
            }

            foreach ($labels as $label) {
                $labelName = sprintf("info[label][%s]", $label['name']);
                $input     = BSHtml::textInput($labelName, $label['default']);
                echo BSHtml::formItem(BSHtml::label($label['title']) . $input);
            }
            ?>
        </td>
    </tr>
    <tr>
        <th class="text-right">Name</th>
        <td><?= BSHtml::textInput("info[name]", $name) ?></td>
    </tr>
    <tr>
        <th class="text-right">Description</th>
        <td><?= BSHtml::textarea('info[description]', $description) ?></td>
    </tr>
    <tr>
        <th class="text-right">Table</th>
        <td><?= BSHtml::dropDownList("info[table]", $table, $tableList, ['prompt' => '请选择绑定表']) ?></td>
    </tr>
    <tr>
        <th class="text-right">Options</th>
        <td>
            <?php
            foreach ($options as $option) {
                $inputType  = $option['type'];
                $fieldValue = $option['value'];
                $fieldName  = sprintf("info[options][%s]", $option['name']);
                $label      = "";
                if (isset($option['label'])) {
                    $label = $option['label'];
                }
                $fieldName = sprintf("info[options][%s]", $option['name']);
                echo BSHtml::createFormElement($inputType, $label, $fieldName, $fieldValue, $option['config']);
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
