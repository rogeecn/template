<?php

use plugins\LayUI\components\GridView;
use plugins\LayUI\components\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ArticleTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>


<?php
\plugins\LayUI\components\ActiveForm::begin();
echo \plugins\LayUI\components\Html::beginTag("div", ['style' => 'text-align:right']);
$btnSave   = \plugins\LayUI\components\Html::submitButton("保存");
$btnCreate = \plugins\LayUI\components\Html::a("创建", ['/admin/article/type/manage/create'], ['class' => 'layui-btn']);
echo \plugins\LayUI\components\Html::buttonGroup([$btnCreate, $btnSave]);
echo \plugins\LayUI\components\Html::endTag("div");
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider, 'columns' => [
        [
            'class'         => \plugins\LayUI\components\DndColumn::className(),
            'headerOptions' => ['width' => 20],
            'content'       => function ($model) {
                $dndIcon = Html::icon("arrows", ['drag-handle']);

                $orderAttr   = [
                    'data-old' => $model->order,
                    'data-id'  => $model->primaryKey,
                ];
                $name        = sprintf("order[%d]", $model->primaryKey);
                $hiddenInput = Html::hiddenInput($name, $model->order, $orderAttr);
                return $dndIcon . $hiddenInput;

            },
        ],
        'id',
        'name',
        'alias',
        'description',
        'order',
        [
            'class'    => \plugins\LayUI\components\ActionColumn::className(),
            'template' => '{column} {update} {delete}',
            'buttons'  => [
                'column' => function ($url, $model, $key) {
                    return Html::a('[字段编辑]', ['/admin/article/field/manage','type'=>$model->id]);
                },
            ],
        ],
    ],
]); ?>
<?php \plugins\LayUI\components\ActiveForm::end(); ?>
