<?php

use common\extend\BSHtml;
use common\extend\Table;

/* @var $this yii\web\View */
/* @var $allFields array */
/* @var $typeFields array */
?>
<?= Table::widget([
    'dataProvider' => $allFields,
    'columns'      => [
        "class",
        "name",
        "table",
        "description",
        [
            'value' => function ($data) use ($type) {
                return BSHtml::a("添加", ["/admin/article/field/attach/bind-info", 'class' => $data['class'], 'type' => $type]);
            },
        ],
    ],
])
?>
