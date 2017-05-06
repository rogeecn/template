<?php
use LayUI\components\Html;
use LayUI\components\ActiveForm;
use modules\category\models\Category;
/** @var Category $model */

\LayUI\LayUIAssets::register($this);


$form = ActiveForm::begin();


echo $form->field($model,"pid")->dropdownList($model->getFlatIndentList(true));
echo $form->field($model,"name")->textInput();
echo $form->field($model,"alias")->textInput();


echo Html::submitWrapper(Html::submitButton());
ActiveForm::end();
