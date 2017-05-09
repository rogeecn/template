<?php

use LayUI\components\ActiveForm;
use LayUI\components\Html;
use modules\article\models\Article;
use modules\category\models\Category;

/* @var $this yii\web\View */
/* @var $allFields array */
/* @var $typeFields array */
?>

<table width="100%">
    <tbody>
    <tr>
        <td width="60%" style="vertical-align: text-top;">
            <?=\LayUI\components\Table::widget([
                'dataProvider'=>$typeFields,
                'columns'=>[
                    "label",
                    "name",
                    "description",
                    "options",
                    [
                        'value'=>function($data){
                           $editBtn =  Html::a("[编辑] ",["/article/field/manage/update",'id'=>$data['id']]);
                            $deleteBtn = Html::a("[删除]",["/article/field/manage/delete",'id'=>$data['id']]);
                            return $editBtn.$deleteBtn;
                        }
                    ],
                ]
            ])
            ?>

        </td>

        <td width="5%"></td>

        <td width="35%" style="vertical-align: text-top;">
            <?=\LayUI\components\Table::widget([
                'dataProvider'=>$allFields,
                'columns'=>[
                    "name",
                    "class",
                    [
                        'value'=>function($data) use ($type){
                            return Html::a("添加",["/article/field/manage/create",'class'=>$data['class'],'type'=>$type]);
                        }
                    ]
                ]
            ])
            ?>
        </td>
    </tr>
    </tbody>
</table>
