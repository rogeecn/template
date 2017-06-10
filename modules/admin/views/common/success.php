<div class="row" style="margin-top: 40px;">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3>成功</h3>
            </div>
            <div class="panel-body">
                <?= $msg ?>
            </div>
            <div class="panel-footer" style="text-align: right;">
                <?php foreach ($buttons as $button) {
                    echo $button;
                } ?>
            </div>
        </div>
    </div>
</div>
