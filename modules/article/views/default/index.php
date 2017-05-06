<?php

use LayUI\components\ActiveForm;
use LayUI\components\GridView;
use LayUI\components\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\Article */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Articles';
$this->params['breadcrumbs'][] = $this->title;

?>
<?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
]); ?>
<?= \LayUI\components\Table::widget([
    'dataProvider' => [1],
    'showHeader'   => false,
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
                return Html::activeTextInput($searchModel, "index_show", ['placeholder' => 'index_show']);
            },
        ],
        [
            'value' => function () use ($searchModel) {
                return Html::activeTextInput($searchModel, "status", ['placeholder' => 'status']);
            },
        ],
        [
            'value' => function () use ($searchModel) {
                $submitBtn = Html::submitButton();
                $resetBtn  = Html::resetButton();
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
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'title',
        'user_id',
        'type',
        'index_show',
        'status',
        'created_at:datetime',
        'created_at:datetime',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
<?php Pjax::end(); ?>
