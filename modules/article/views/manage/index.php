<?php

use modules\category\models\Category;
use modules\article\models\Article;
use LayUI\components\ActiveForm;
use LayUI\components\GridView;
use LayUI\components\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel Article */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
]); ?>
<?= \LayUI\components\Table::widget([
    'dataProvider' => [1],
    'showHeader'   => false,
    "colGroup"     => [120, 0, 0, 0, 120,120, 175],
    'columns'      => [
        [
            'value' => function () use ($searchModel) {
                return Html::activeTextInput($searchModel, "id", ['placeholder' => 'id']);
            },
        ],
        [
            'value' => function () use ($searchModel) {
                return Html::activeTextInput($searchModel, "user_id", ['placeholder' => 'user_id']);
            },
        ],
        [
            'value' => function () use ($searchModel) {
                return Html::activeTextInput($searchModel, "type", ['placeholder' => 'type']);
            },
        ],
        [
            'value' => function () use ($searchModel) {
                return Html::activeDropDownList($searchModel, "index_show", [1=>'是',0=>'否'],[
                    'prompt' => '首页展示'
                ]);
            },
        ],
        [
            'value' => function () use ($searchModel) {
                $list = Category::getFlatIndentList();
                return Html::activeDropDownList($searchModel, "category_id", $list, [
                    'prompt'      => '所有',
                ]);
            },
        ],
        [
            'value' => function () use ($searchModel) {
                $list = Article::getStatusList();
                return Html::activeDropDownList($searchModel, "status", $list, [
                    'prompt'      => '所有',
                ]);
            },
        ],
        [
            'value' => function () use ($searchModel) {
                $submitBtn = Html::submitButton();
                $resetBtn  = Html::resetButton("重置",['default/index']);
                return $submitBtn . $resetBtn;
            },
        ],
    ],
]) ?>
<?php ActiveForm::end(); ?>


<?php Pjax::begin(); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns'      => [
        'id',
        'title',
        [
            'attribute'=>'category_id',
            'value'=>function($data){
                return Category::getName($data->category_id);
            },
        ],
        'user_id',
        'type',
        [
            'attribute'=>'index_show',
            'value'=>function($data){
                return $data->index_show == 1?'是':'否';
            },
        ],
        'status',
        'created_at:datetime',
        'created_at:datetime',

        [
            'class' => \LayUI\components\ActionColumn::className(),
        ],
    ],
]); ?>
<?php Pjax::end(); ?>
