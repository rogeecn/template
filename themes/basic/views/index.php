<?php

use common\extend\Html;

/** @var $this \common\extend\View */
?>
<div>-----------------------------------------------------------------</div>

<div class="clearfix">
    <div class="content">
        <?= \application\widgets\Box::widget([
            'titleMain'     => Html::tag("h1", "HTML/CSS"),
            'titleMore'     => Html::a("more", "#"),
            'bodyContent'   => "hello world!",
//            'bodyContent'        => ["hello", "world!"],
            'bodyOptions'   => [
                'class' => 'name',
            ],
            'footerContent' => ["hello", "world!"],
            'footerOptions' => [
                'class' => 'footer class',
            ],

        ]) ?>
    </div>
</div>


<div>-----------------------------------------------------------------</div>
