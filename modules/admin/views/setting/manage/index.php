<?php
/** @var \yii\web\View $this */
?>
<?php
$form = \plugins\LayUI\components\ActiveForm::begin();

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
    echo \plugins\LayUI\components\Tabs::widget([
        'items' => $items,
    ]);
    echo \plugins\LayUI\components\Html::submitWrapper(\plugins\LayUI\components\Html::submitButton());
}
\plugins\LayUI\components\ActiveForm::end();
