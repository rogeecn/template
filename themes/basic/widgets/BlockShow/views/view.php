<?php
use yii\helpers\Html;
echo Html::beginTag($tag, $tagOptions);
echo Html::tag("div", $band, ['class' => 'band']);
echo Html::tag("div", $title, ['class' => 'title']);
echo Html::tag("div", $content, ['class' => 'info']);
echo Html::endTag($tag);

