<?php

use common\models\Article;
use common\models\Category;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model Article */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->errorSummary($model) ?>
<?= $form->field($model, "type")->label(FALSE)->hiddenInput() ?>
<?= $form->field($model, "title")->textInput() ?>
<?= $form->field($model, "category_id")->dropDownList(Category::getFlatIndentList(TRUE)) ?>

<?php
//= $form->field($model, "index_show")->label("&nbsp")->checkbox(['title'=>'首页展示'])
?>

<?php
foreach ($typeFields as $typeField) {
    echo $typeField['class']::field([
        'action' => \common\base\Field::ACTION_RENDER,
        'config' => $typeField,
        'dataID' => $model->id,
    ]);
} ?>

<?= \common\extend\BSHtml::submitButton() ?>
<?php ActiveForm::end() ?>
