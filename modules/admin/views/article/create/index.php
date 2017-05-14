<?php

use LayUI\components\ActiveForm;
use LayUI\components\Html;
use common\models\Article;
use common\models\Category;

/* @var $this yii\web\View */
/* @var $model Article */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<?php $form = ActiveForm::begin(); ?>
<?=$form->errorSummary($model)?>
<?= $form->field($model, "type")->label(false)->hiddenInput() ?>
<?= $form->field($model, "title")->textInput() ?>
<?= $form->field($model, "category_id")->dropDownList(Category::getFlatIndentList()) ?>
<?php
//= $form->field($model, "index_show")->label("&nbsp")->checkbox(['title'=>'首页展示'])
?>
<?php  foreach ($typeFields as $typeField):?>
    <?=$typeField['class']::field([
        'action'=>\common\base\Field::ACTION_RENDER,
        'config'=>$typeField
    ])?>
<?php endforeach;?>
<?= Html::submitWrapper(Html::submitButton()) ?>
<?php ActiveForm::end() ?>
