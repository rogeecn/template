<?php
use LayUI\components\ActiveForm;
use LayUI\components\GridView;
use LayUI\components\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Tags';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(); ?>
<?= \LayUI\components\Table::widget([
    'dataProvider' => [1],
    'showHeader'   => false,
    "colGroup"=>["",175],
    'columns'      => [
        [
            'value' => function () use ($searchModel) {
                return Html::activeTextInput($searchModel, "name", ['placeholder' => '关键字']);
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
        'name',
        'reference_count',
        ['class' => \LayUI\components\ActionColumn::className()],
    ],
]); ?>
<?php Pjax::end(); ?>
