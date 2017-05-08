<?php

use LayUI\components\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel modules\article\models\ArticleTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<?= \LayUI\components\Html::a("创建",['/article/type/manage/create'],['class'=>'layui-btn'])?>

<?php Pjax::begin(); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns'      => [
        'id',
        'name',
        'alias',
        'description',
        'order',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
<?php Pjax::end(); ?>
