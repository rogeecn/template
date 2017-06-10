<?php
use common\extend\BSHtml;
use yii\bootstrap\ActiveForm;

/** @var \yii\web\View $this */
?>
    <style>
        .tab-content {
            padding: 20px 0;
        }
    </style>
<?php
$form = ActiveForm::begin();

$items = [];
foreach ($groupList as $groupID => $groupData) {
    $items[] = [
        'label'   => $groupData['name'],
        'content' => $this->render("_tab", [
            'form'    => $form,
            'columns' => $groupData['columns'],
        ]),
    ];
}
$items[0]['active'] = true;


if (!empty($items)) {
    echo \yii\bootstrap\Tabs::widget([
        'items' => $items,
    ]);
    echo BSHtml::submitButton();
}
ActiveForm::end();
