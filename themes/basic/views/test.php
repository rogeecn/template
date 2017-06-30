<?php

?>

<?= \application\widgets\Carousel::widget([
    'items' => \themes\basic\util\CarouselDataProvider::widget(),
]) ?>

<?= \application\widgets\Breadcrumbs::widget([
    'categoryID' => 11,
    'linkList'   => [
        ['label' => 'itemAppend', 'url' => '#'],
        "pure text",
    ],
]); ?>

