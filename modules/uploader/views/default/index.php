<?php
/** @var \yii\web\View $this */
?>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    body {
        padding: 100px;
    }
</style>

<?= \plugins\Uploader\Plugin::widget(['wrapper' => 'uploader']); ?>
<?php
/*echo \modules\uploader\widget\UploaderWidget::widget([
    'name'  => 'file',
    'value' => [
        '/images/image.jpg',
        '/images/image.jpg',
        '/images/image.jpg',
    ],
]);*/


?>

