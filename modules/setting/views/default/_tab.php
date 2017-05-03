<?php
use yii\bootstrap\Html;
use modules\setting\models\Setting;
/** @var \yii\bootstrap\ActiveForm $form */
?>
<?php foreach ($columns as $column)?>
    <div class="form-group">
        <label><?=$column['title']?></label>
<?php
    switch($column['type']){
        case Setting::TYPE_STRING:
            echo Html::textInput($column['alias'],$column['value'],['class'=>'form-control']);
            break;
        case Setting::TYPE_TEXT:
            echo Html::textarea($column['alias'],$column['value'],['class'=>'form-control']);
            break;
        case Setting::TYPE_SINGLE_SELECT:
            echo Html::dropDownList($column['alias'],$column['value'],$column["pre_configure"],['class'=>'form-control']);
            break;
        case Setting::TYPE_MULTI_SELECT:
            echo Html::dropDownList($column['alias'],$column['value'],$column["pre_configure"],[
                    'multiple'=>true,
                    'style'=>"height:50px",
                    'class'=>'form-control'
            ]);
            break;
        case Setting::TYPE_HTML:
            echo \modules\ueditor\widget\UEditorInput::widget([
                    'name'=>$column['alias'],
                    'value'=>$column['value'],
            ]);
            break;
    }
?>
        <span class="help-block"><?=$column['hint']?></span>
</div>
