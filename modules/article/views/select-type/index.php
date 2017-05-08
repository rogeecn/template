<?php
use LayUI\components\Html;
/** @var array $types */
/** @var \yii\web\View $this */

\LayUI\LayUIAssets::register($this);
?>
<?php foreach ($typeList as $typeAlias=>$typeInfo):?>
    <blockquote class="layui-elem-quote" style="margin-top: 20px;">
        <h1><?=Html::a($typeInfo['label'],['/article/create','type'=>$typeAlias],['style'=>'font-size: 18px;color: #01aaed'])?></h1>
        <hr>
        <p><?=$typeInfo['description']?></p>
    </blockquote>
<?php endforeach;?>
