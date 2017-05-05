<?php
use LayUI\components\ActiveForm;
use modules\category\models\Category;

\LayUI\LayUIAssets::register($this);


echo "\n\n\n";

$form = ActiveForm::begin();

echo "\n\n\n";
//echo $form->field($model,"pid")->dropdownList([123,123,123]);
//echo $form->field($model,"pid")->radioList([123,123,123]);
//echo $form->field($model,"pid")->checkboxList([123,123,123]);
//echo $form->field($model,"pid")->radio();
//echo $form->field($model,"pid")->checkbox();
//echo $form->field($model,"name")->textInput();
//echo $form->field($model,"name")->textarea(['rows'=>10]);
echo $form->field($model,"name")->editor(['rows'=>10]);
//echo $form->field($model,"alias")->textInput();
echo "\n\n\n";
\LayUI\components\Html::submitButton();
ActiveForm::end();
echo "\n\n\n";
