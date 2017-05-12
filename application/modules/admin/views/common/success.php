<?php
\LayUI\LayUIAssets::register($this);
?>
<div style="width: 600px;margin: 10% auto;">
        <blockquote class="layui-elem-quote">
            <h1 style="color: #5FB878;font-size: 22px;margin-bottom: 1em;">成功</h1>
            <p style="padding: 1em 0;"><?=$msg?></p>
            <hr>
            <div class="tip-buttons" style="text-align: right;">
                <?php foreach ($buttons as $button){
                    echo $button;
                }?>
            </div>
        </blockquote>
</div>