<?php
use common\extend\BSHtml;
use common\extend\Table;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Tags';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(); ?>
<?= Table::widget([
    'dataProvider' => [1],
    'showHeader'   => false,
    "colGroup"     => ["", 175],
    'columns'      => [
        [
            'value' => function () use ($searchModel) {
                return BSHtml::activeTextInput($searchModel, "name", ['placeholder' => '关键字']);
            },
        ],
        [
            'value' => function () use ($searchModel) {
                $submitBtn = BSHtml::submitButton();
                $resetBtn  = BSHtml::resetButton();

                return $submitBtn . "&nbsp;" . $resetBtn;
            },
        ],
    ],
]) ?>
<?php ActiveForm::end(); ?>

<?php Pjax::begin(); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns'      => [
        'name',
        'reference_count',
    ],
]); ?>
<?php Pjax::end(); ?>
