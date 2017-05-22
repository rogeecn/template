<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<?php
$export = [
    'label'   => '导出',
    'content' => $this->render("_export", ['dataList' => $dataList]),
];

$import = [
    'label'   => '导入',
    'active'  => TRUE,
    'content' => $this->render("_import"),
];

echo \plugins\LayUI\components\Tabs::widget([
    'items' => [$import, $export],
]);
?>

