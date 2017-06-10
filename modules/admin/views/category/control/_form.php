<?php
use common\extend\BSHtml;
use common\models\Category;
use yii\bootstrap\ActiveForm;

/** @var \common\models\Category $model */

$form = ActiveForm::begin();

$categoryList = Category::getFlatIndentList(true);
$size         = 30;
if (count($categoryList) < 30) {
    $size = count($categoryList);
}
$categoryList = $form->field($model, "pid")->dropDownList($categoryList, ['size' => $size]);
?>

<div class="row">
    <div class="col-xs-2"><?= $categoryList ?></div>
    <div class="col-xs-10">
        <?php
        echo $form->field($model, "name")->textInput();
        echo $form->field($model, "alias")->textInput();
        echo BSHtml::submitButton();
        ?>
    </div>
</div>
<?php
ActiveForm::end();
?>
