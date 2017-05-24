<?php

use plugins\LayUI\components\ActiveForm;
use plugins\LayUI\components\GridView;
use plugins\LayUI\components\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
]); ?>

<?= \plugins\LayUI\components\Table::widget([
    'dataProvider' => [1],
    'showHeader'   => FALSE,
    "colGroup"     => [0, 0, 0, 175],
    'columns'      => [
        [
            'value' => function () use ($searchModel) {
                return Html::activeTextInput($searchModel, "id", ['placeholder' => 'id']);
            },
        ],
        [
            'value' => function () use ($searchModel) {
                return Html::activeTextInput($searchModel, "username", ['placeholder' => '关键字']);
            },
        ],
        [
            'value' => function () use ($searchModel) {
                return Html::activeDropDownList($searchModel, "role", \common\models\MemberRole::getList(), [
                    'prompt' => '----请选择----',
                ]);
            },
        ],
        [
            'value' => function () use ($searchModel) {
                return Html::activeDropDownList($searchModel, "status", \common\User::getStatusList(), [
                    'prompt' => '----请选择----',
                ]);
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
        'id',
        'username',
        'email',
        'password',
        [
            'attribute' => 'role',
            'value'     => function ($data) {
                return \common\models\MemberRole::getRoleNameByID($data->role);
            },
        ],
        [
            'attribute' => 'status',
            'value'     => function ($data) {
                return \common\User::getStatusValue($data->status);
            },
        ],
        'created_at:datetime',
        [
            'class'   => \plugins\LayUI\components\ActionColumn::className(),
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a("[编辑]", ['/admin/member/update', 'id' => $model->id]);
                },
            ],
        ],
    ],
]); ?>
<?php Pjax::end(); ?>
