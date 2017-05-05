<?php
/** @var \yii\web\View $this */
?>
<?php
$form = \LayUI\components\ActiveForm::begin();

$items = [];
foreach ($groupList as $groupID=>$groupData) {
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
    echo \LayUI\components\Tabs::widget([
        'items' => $items,
    ]);
    echo \LayUI\components\Html::submitWrapper(\LayUI\components\Html::submitButton());
}
\LayUI\components\ActiveForm::end();
