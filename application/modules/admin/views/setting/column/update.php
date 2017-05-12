<?php
/** @var \yii\web\View $this */
\yii\bootstrap\BootstrapThemeAsset::register($this)
?>
    <h1>Update</h1>

<?= $this->render("_form", ['model' => $model]); ?>