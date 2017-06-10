<?php
use common\extend\BSHtml;
use common\models\Setting;

/** @var \yii\bootstrap\ActiveForm $form */
?>
<?php foreach ($columns as $column): ?>
    <div class="form-group">
        <label class=""><?= $column['title'] ?></label>
        <?php
        switch ($column['type']) {
            case Setting::TYPE_TEXT:
                echo BSHtml::textarea($column['formName'], $column['value']);
                break;
            case Setting::TYPE_SINGLE_SELECT:
                echo BSHtml::radioList($column['formName'], $column['value'], $column["pre_configure"]);
                break;
            case Setting::TYPE_MULTI_SELECT:
                echo BSHtml::checkboxList($column['formName'], $column['value'], $column["pre_configure"]);
                break;
            case Setting::TYPE_HTML:
                echo modules\ueditor\widget\UEditorInput::widget([
                    'name'  => $column['formName'],
                    'value' => $column['value'],
                ]);
                break;
            default:
                echo BSHtml::textInput($column['formName'], $column['value']);
        }
        ?>
        <?= BSHtml::hint($column['hint']) ?>
    </div>
<?php endforeach; ?>
