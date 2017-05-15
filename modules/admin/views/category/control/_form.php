<?php
use plugins\LayUI\components\Html;
use common\models\Category;
use plugins\LayUI\components\ActiveForm;
/** @var \common\models\Category $model */

\plugins\LayUI\LayUIAssets::register($this);


$form = ActiveForm::begin();


echo $form->field($model,"pid")->dropdownList(Category::getFlatIndentList(true));
echo $form->field($model,"name")->textInput();
echo $form->field($model,"alias")->textInput();


echo Html::submitWrapper(Html::submitButton());
ActiveForm::end();
