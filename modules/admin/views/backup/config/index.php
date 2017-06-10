<?php

use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<style>
    .tab-content {
        padding: 20px 0;
    }
</style>
<?php
$export = [
    'label'   => '导出',
    'content' => $this->render("_export", ['dataList' => $dataList]),
];

$import = [
    'label'   => '导入',
    'active'  => true,
    'content' => $this->render("_import"),
];

echo Tabs::widget([
    'items' => [$import, $export],
]);
?>

