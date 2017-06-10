<?php
use common\extend\BSHtml;

?>
<div class="row" style="margin-top: 40px;">
    <div class="col-md-4 col-md-offset-4">

        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3>失败</h3>
            </div>
            <ul style="padding: 1em 0;">
                <?php foreach ($reasons as $key => $reason): ?>
                    <li><?= sprintf("%s: %s", $key, $reason) ?></li>
                <?php endforeach; ?>
            </ul>
            <hr>
            <div class="panel-footer" style="text-align: right;">
                <?= BSHtml::linkButton("返回修改", '#', ['color' => 'primary', 'onClick' => 'javascript:history.go(-1)']) ?>
            </div>
        </div>

    </div>
</div>
