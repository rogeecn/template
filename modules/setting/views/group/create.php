<?php
/** @var \yii\web\View $this */
    \yii\bootstrap\BootstrapThemeAsset::register($this)
?>
<h1>Create</h1>

<?=$this->render("_form",['model'=>$model]);?>