<?php
/** @var \yii\web\View $this */
?>
<style>
    .tab-content{
        padding-top:20px;
    }
</style>
<?php $form = \yii\bootstrap\ActiveForm::begin()?>

<?php
$items = [];
foreach ($groupList as $groupData){
    $items[] = [
            'label'=>$groupData['name'],
            'content'=>$this->render("_tab",[
                    'form'=>$form,
                    'columns'=>$groupData['columns'],
            ])
    ];
}
$items[0]['active'] = true;
?>
<?=\yii\bootstrap\Tabs::widget([
    'items' => $items
])?>
<?= \yii\bootstrap\Html::submitButton("Submit",['class'=>'btn btn-primary'])?>
<?php \yii\bootstrap\ActiveForm::end();?>
