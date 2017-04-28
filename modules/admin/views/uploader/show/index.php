<?php
/** @var \yii\web\View $this */
\modules\ueditor\assets\UEditorAssets::register($this);
$this->registerJs('var ue = UE.getEditor("editor");')
?>
<div class="row">
    <div class="col-md-12">
        <textarea name="" id="editor" cols="30" rows="10"></textarea>
    </div>
</div>

