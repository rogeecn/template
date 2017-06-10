<?php

use common\extend\BSHtml;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\extend\Table;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
]); ?>

<?= Table::widget([
    'dataProvider' => [1],
    'showHeader'   => false,
    "colGroup"     => [0, 0, 0, 175],
    'columns'      => [
        [
            'value' => function () use ($searchModel) {
                return BSHtml::activeTextInput($searchModel, "id", ['placeholder' => 'id']);
            },
        ],
        [
            'value' => function () use ($searchModel) {
                return BSHtml::activeTextInput($searchModel, "username", ['placeholder' => '关键字']);
            },
        ],
        [
            'value' => function () use ($searchModel) {
                return BSHtml::activeDropDownList($searchModel, "role", \common\models\MemberRole::getList(), [
                    'prompt' => '----请选择----',
                ]);
            },
        ],
        [
            'value' => function () use ($searchModel) {
                return BSHtml::activeDropDownList($searchModel, "status", \common\User::getStatusList(), [
                    'prompt' => '----请选择----',
                ]);
            },
        ],
        [
            'value' => function () use ($searchModel) {
                $submitBtn = BSHtml::submitButton();
                $resetBtn  = BSHtml::resetButton();

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
            'class'   => \common\extend\ActionColumn::className(),
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return BSHtml::a("[编辑]", ['/admin/member/update', 'id' => $model->id]);
                },
            ],
        ],
    ],
]); ?>
<?php Pjax::end(); ?>
