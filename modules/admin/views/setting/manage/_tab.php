<?php
use common\models\Setting;
use plugins\LayUI\components\Html;

/** @var \yii\bootstrap\ActiveForm $form */
?>
<?php foreach ($columns as $column): ?>
<div class="layui-form-item">
    <label class="layui-form-label"><?= $column['title'] ?></label>
    <div class="layui-input-inline">
    <?php
    switch ($column['type']) {
        case Setting::TYPE_TEXT:
            echo Html::textarea($column['formName'], $column['value']);
            break;
        case Setting::TYPE_SINGLE_SELECT:
            echo Html::radioList($column['formName'], $column['value'], $column["pre_configure"] );
            break;
        case Setting::TYPE_MULTI_SELECT:
            echo Html::checkboxList($column['formName'], $column['value'], $column["pre_configure"]);
            break;
        case Setting::TYPE_HTML:
            echo modules\ueditor\widget\UEditorInput::widget([
                'name'  => $column['formName'],
                'value' => $column['value'],
            ]);
            break;
        default:
            echo Html::textInput($column['formName'], $column['value']);
    }
    ?>
    </div>
    <?= Html::hint($column['hint']) ?>
</div>
<?php endforeach;?>
