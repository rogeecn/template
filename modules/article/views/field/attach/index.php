<?php

use LayUI\components\ActiveForm;
use LayUI\components\Html;
use modules\article\models\Article;
use modules\category\models\Category;

/* @var $this yii\web\View */
/* @var $allFields array */
/* @var $typeFields array */
?>
<?=\LayUI\components\Table::widget([
    'dataProvider'=>$allFields,
    'columns'=>[
        "class",
        "name",
        "table",
        "description",
        [
            'value'=>function($data) use ($type){
                return Html::a("添加",["/article/field/attach/bind-info",'class'=>$data['class'],'type'=>$type]);
            }
        ]
    ]
])
?>
