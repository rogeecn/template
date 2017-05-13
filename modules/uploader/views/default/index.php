<?php
/** @var \yii\web\View $this */
?>
<style>
    body{
        padding: 100px;
    }
    ul>li{
        display: inline-block;
        padding: 10px;
        width: 200px;
        height: 200px;
        border: 1px solid #c2ccd1;
    }
    ul>li img{
        max-width: 100%;
    }
</style>

<?php
echo \modules\uploader\widget\UploaderWidget::widget([
    'name'  => 'file',
    'value' => [
        '/images/image.jpg',
        '/images/image.jpg',
        '/images/image.jpg',
    ],
]);
?>

