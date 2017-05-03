<?php
/** @var \yii\web\View $this */
?>
    <style>
        .tab-content {
            padding-top: 20px;
        }
    </style>
<?php
$form = \yii\bootstrap\ActiveForm::begin();

$items = [];
foreach ($groupList as $groupData) {
    $items[] = [
        'label'   => $groupData['name'],
        'content' => $this->render("_tab", [
            'form'    => $form,
            'columns' => $groupData['columns'],
        ]),
    ];
}
$items[0]['active'] = true;

if (empty($items)) {
    echo \yii\bootstrap\Tabs::widget([
        'items' => $items,
    ]);
    echo \yii\bootstrap\Html::submitButton("Submit", ['class' => 'btn btn-primary']);
}
\yii\bootstrap\ActiveForm::end();
