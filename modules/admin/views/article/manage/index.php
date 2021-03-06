<?php

use common\models\Article;
use common\models\ArticleType;
use common\models\Category;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel Article */
/* @var $dataProvider yii\data\ActiveDataProvider */

$articleTypeList = ArticleType::getList();
$statusList      = Article::getStatusList();

?>
<?php $form = \yii\bootstrap\ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
]); ?>
<?= \common\extend\Table::widget([
    'dataProvider' => [1],
    'showHeader'   => false,
    "colGroup"     => [120, 0, 120, 140, 140, 140, 140, 175],
    'columns'      => [
        [
            'value' => function () use ($searchModel) {
                return \common\extend\BSHtml::activeTextInput($searchModel, "id", ['placeholder' => 'id']);
            },
        ],
        [
            'value' => function () use ($searchModel) {
                return \common\extend\BSHtml::activeTextInput($searchModel, "title", ['placeholder' => 'title']);
            },
        ],
        [
            'value' => function () use ($searchModel) {
                return \common\extend\BSHtml::activeTextInput($searchModel, "user_id", ['placeholder' => 'userID']);
            },
        ],
        [
            'value' => function () use ($searchModel, $articleTypeList) {
                return \common\extend\BSHtml::activeDropDownList($searchModel, "type", $articleTypeList, [
                    'prompt' => '所有类型',
                ]);
            },
        ],
        [
            'value' => function () use ($searchModel) {
                return \common\extend\BSHtml::activeDropDownList($searchModel, "index_show", [1 => '是', 0 => '否'], [
                    'prompt' => '首页展示',
                ]);
            },
        ],
        [
            'value' => function () use ($searchModel) {
                $list = Category::getFlatIndentList();

                return \common\extend\BSHtml::activeDropDownList($searchModel, "category_id", $list, [
                    'prompt' => '所有分类',
                ]);
            },
        ],
        [
            'value' => function () use ($searchModel, $statusList) {
                return \common\extend\BSHtml::activeDropDownList($searchModel, "status", $statusList, [
                    'prompt' => '所有',
                ]);
            },
        ],
        [
            'value' => function () use ($searchModel) {
                $submitBtn = \common\extend\BSHtml::submitButton();
                $resetBtn  = \common\extend\BSHtml::resetButtonLink("重置", ['/admin/article/manage']);

                return $submitBtn ."&nbsp;". $resetBtn;
            },
        ],
    ],
]) ?>
<?php \yii\bootstrap\ActiveForm::end(); ?>


<?php Pjax::begin(); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns'      => [
        'id',
        [
            'attribute' => 'title',
            'format'    => 'raw',
            'value'     => function ($data) {
                return \common\extend\BSHtml::a($data->title, $this->articleIDURL($data['id']), ['target' => '_blank']);
            },
        ],
        [
            'attribute' => 'category_id',
            'value'     => function ($data) {
                return Category::getName($data->category_id);
            },
        ],
        'user_id',
        [
            'attribute' => 'type',
            'value'     => function ($data) use ($articleTypeList) {
                if (!isset($articleTypeList[$data->type])) {
                    return "无";
                }

                return $articleTypeList[$data->type];
            },
        ],
        [
            'attribute' => 'index_show',
            'value'     => function ($data) {
                return $data->index_show == 1 ? '是' : '否';
            },
        ],
        [
            'attribute' => 'status',
            'value'     => function ($data) use ($statusList) {
                return $statusList[$data->status];
            },
        ],
        'created_at:datetime',
        'updated_at:datetime',

        [
            'class'   => \common\extend\ActionColumn::className(),
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return \common\extend\BSHtml::a("[编辑]", ['/admin/article/update', 'id' => $model->id]);
                },
                'delete' => function ($url, $model, $key) {
                    return \common\extend\BSHtml::a("[删除]", ['/admin/article/delete', 'id' => $model->id, 'page' => \common\util\Request::input("page", 1)], [
                        'data-confirm' => '确认删除?',
                        'data-method'  => 'post',
                    ]);
                },
            ],
        ],
    ],
]); ?>
<?php Pjax::end(); ?>
