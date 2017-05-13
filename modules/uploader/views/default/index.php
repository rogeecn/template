<?php
/** @var \yii\web\View $this */
?>
<style>
    body {
        padding: 100px;
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

