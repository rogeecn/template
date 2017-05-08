<?php

use LayUI\components\ActiveForm;
use LayUI\components\Html;
use modules\article\models\Article;
use modules\category\models\Category;

/* @var $this yii\web\View */
/* @var $model Article */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<?php $form = ActiveForm::begin(); ?>
<?=$form->errorSummary($model)?>
<?= $form->field($model, "type")->label(false)->hiddenInput() ?>
<?= $form->field($model, "title")->textInput() ?>
<?= $form->field($model, "category_id")->dropDownList(Category::getFlatIndentList()) ?>
<?= $form->field($model, "index_show")->label("&nbsp")->checkbox(['title'=>'首页展示']) ?>
<?= Html::submitWrapper(Html::submitButton()) ?>
<?php ActiveForm::end() ?>
