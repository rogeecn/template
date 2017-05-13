<?php
\LayUI\LayUIAssets::register($this);
?>
<div style="width: 600px;margin: 10% auto;">
    <blockquote class="layui-elem-quote" style="border-left-color: #FF5722;">
        <h1 style="color: #FF5722;font-size: 22px;margin-bottom: 1em;">失败</h1>
        <ul style="padding: 1em 0;">
            <?php foreach ($reasons as $key=>$reason):?>
            <li><?=sprintf("%s: %s",$key,$reason)?></li>
            <?php endforeach;?>
        </ul>
        <hr>
        <div class="tip-buttons" style="text-align: right;">
            <?=\LayUI\components\Html::linkButton("返回修改",'#',['color'=>'primary','onClick'=>'javascript:history.go(-1)'])?>
        </div>
    </blockquote>
</div>
