<?php

use common\extend\BSHtml;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ArticleTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>


<?php
ActiveForm::begin();
$btnSave   = BSHtml::submitButton("保存");
$btnCreate = BSHtml::a("创建", ['/admin/article/type/manage/create'], ['class' => 'btn btn-default']);
echo BSHtml::div($btnSave . "&nbsp;" . $btnCreate, ['style' => 'text-align:right'])
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider, 'columns' => [
        [
            'class'         => \common\extend\DndColumn::className(),
            'headerOptions' => ['width' => 20],
            'content'       => function ($model) {
                $dndIcon = BSHtml::icon("arrows", "", ['class' => 'drag-handle']);

                $orderAttr   = [
                    'data-old' => $model->order,
                    'data-id'  => $model->primaryKey,
                ];
                $name        = sprintf("order[%d]", $model->primaryKey);
                $hiddenInput = BSHtml::hiddenInput($name, $model->order, $orderAttr);

                return $dndIcon . $hiddenInput;

            },
        ],
        'id',
        'name',
        'alias',
        'description',
        'order',
        [
            'class'    => \common\extend\ActionColumn::className(),
            'template' => '{column} {update} {delete}',
            'buttons'  => [
                'column' => function ($url, $model, $key) {
                    return BSHtml::a('[字段编辑]', ['/admin/article/field/manage', 'type' => $model->id]);
                },
            ],
        ],
    ],
]); ?>
<?php ActiveForm::end(); ?>
