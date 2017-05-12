<?php

use LayUI\components\GridView;
use LayUI\components\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ArticleTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>


<?php
\LayUI\components\ActiveForm::begin();
echo \LayUI\components\Html::beginTag("div", ['style' => 'text-align:right']);
$btnSave   = \LayUI\components\Html::submitButton("保存");
$btnCreate = \LayUI\components\Html::a("创建", ['/admin/article/type/manage/create'], ['class' => 'layui-btn']);
echo \LayUI\components\Html::buttonGroup([$btnCreate, $btnSave]);
echo \LayUI\components\Html::endTag("div");
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider, 'columns' => [
        [
            'class'         => \LayUI\components\DndColumn::className(),
            'headerOptions' => ['width' => 20],
            'content'       => function ($model) {
                $dndIcon = \LayUI\components\Html::icon("&#xe649;", ['class' => 'drag-handle']);

                $orderAttr   = [
                    'data-old' => $model->order,
                    'data-id'  => $model->primaryKey,
                ];
                $name        = sprintf("order[%d]", $model->primaryKey);
                $hiddenInput = \LayUI\components\Html::hiddenInput($name, $model->order, $orderAttr);
                return $dndIcon . $hiddenInput;

            },
        ],
        'id',
        'name',
        'alias',
        'description',
        'order',
        [
            'class'    => \LayUI\components\ActionColumn::className(),
            'template' => '{column} {update} {delete}',
            'buttons'  => [
                'column' => function ($url, $model, $key) {
                    return Html::a('[字段编辑]', ['/admin/article/field/manage','type'=>$model->id]);
                },
            ],
        ],
    ],
]); ?>
<?php \LayUI\components\ActiveForm::end(); ?>