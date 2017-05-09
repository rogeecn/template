<?php

use modules\category\models\Category;
use modules\article\models\Article;
use LayUI\components\ActiveForm;
use LayUI\components\GridView;
use LayUI\components\Html;
use yii\widgets\Pjax;
use modules\article\models\ArticleType;

/* @var $this yii\web\View */
/* @var $searchModel Article */
/* @var $dataProvider yii\data\ActiveDataProvider */

$articleTypeList = ArticleType::getList();
$statusList = Article::getStatusList();

?>
<?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
]); ?>
<?= \LayUI\components\Table::widget([
    'dataProvider' => [1],
    'showHeader' => false,
    "colGroup" => [120, 0,120, 140, 140, 140, 140, 175],
    'columns' => [
        [
            'value' => function () use ($searchModel) {
                return Html::activeTextInput($searchModel, "id", ['placeholder' => 'id']);
            },
        ],
        [
            'value' => function () use ($searchModel) {
                return Html::activeTextInput($searchModel, "title", ['placeholder' => 'title']);
            },
        ],
        [
            'value' => function () use ($searchModel) {
                return Html::activeTextInput($searchModel, "user_id", ['placeholder' => 'userID']);
            },
        ],
        [
            'value' => function () use ($searchModel, $articleTypeList) {
                return Html::activeDropDownList($searchModel, "type", $articleTypeList, [
                    'prompt' => '所有类型',
                ]);
            },
        ],
        [
            'value' => function () use ($searchModel) {
                return Html::activeDropDownList($searchModel, "index_show", [1 => '是', 0 => '否'], [
                    'prompt' => '首页展示'
                ]);
            },
        ],
        [
            'value' => function () use ($searchModel) {
                $list = Category::getFlatIndentList();
                return Html::activeDropDownList($searchModel, "category_id", $list, [
                    'prompt' => '所有分类',
                ]);
            },
        ],
        [
            'value' => function () use ($searchModel,$statusList) {
                return Html::activeDropDownList($searchModel, "status", $statusList, [
                    'prompt' => '所有',
                ]);
            },
        ],
        [
            'value' => function () use ($searchModel) {
                $submitBtn = Html::submitButton();
                $resetBtn  = Html::resetButtonLink("重置", ['/article/manage']);
                return $submitBtn . $resetBtn;
            },
        ],
    ],
]) ?>
<?php ActiveForm::end(); ?>


<?php Pjax::begin(); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'title',
        [
            'attribute' => 'category_id',
            'value' => function ($data) {
                return Category::getName($data->category_id);
            },
        ],
        'user_id',
        [
            'attribute' => 'type',
            'value' => function ($data) use ($articleTypeList) {
                if (!isset($articleTypeList[$data->type])) {
                    return "无";
                }
                return $articleTypeList[$data->type];
            },
        ],
        [
            'attribute' => 'index_show',
            'value' => function ($data) {
                return $data->index_show == 1 ? '是' : '否';
            },
        ],
        [
            'attribute' => 'status',
            'value' => function ($data) use ($statusList) {
                return $statusList[$data->status];
            },
        ],
        'created_at:datetime',
        'updated_at:datetime',

        [
            'class' => \LayUI\components\ActionColumn::className(),
        ],
    ],
]); ?>
<?php Pjax::end(); ?>
