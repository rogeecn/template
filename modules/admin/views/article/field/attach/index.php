<?php

use plugins\LayUI\components\ActiveForm;
use plugins\LayUI\components\Html;
use common\models\Article;
use common\models\Category;

/* @var $this yii\web\View */
/* @var $allFields array */
/* @var $typeFields array */
?>
<?=\plugins\LayUI\components\Table::widget([
    'dataProvider'=>$allFields,
    'columns'=>[
        "class",
        "name",
        "table",
        "description",
        [
            'value'=>function($data) use ($type){
                return Html::a("添加",["/admin/article/field/attach/bind-info",'class'=>$data['class'],'type'=>$type]);
            }
        ]
    ]
])
?>
