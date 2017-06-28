<?php
use common\extend\Html;

?>
<header class="nav">
    <div class="container">
        <?= \themes\basic\widgets\NavItem::widget([
            'items'            => \common\models\LinkGroup::getLinkByGroupAlias("nav-top"),
            'containerOptions' => ['class' => 'menu nav-sub text-right'],
        ]) ?>
        <div class="nav-main text-right">
            <h1 class="logo">
                <?php
                $logoImg  = Html::img($this->setting("site.logo"));
                $siteName = $this->setting("site.name");
                $siteUrl  = $this->setting("site.url");
                echo Html::a($logoImg . $siteName, $siteUrl);
                ?>
            </h1>
            <?= \themes\basic\widgets\NavItem::widget([
                'items'   => \common\models\LinkGroup::getLinkByGroupAlias("nav-main"),
                'options' => ['class' => 'menu nav-menu'],
            ]) ?>
        </div>
    </div>
</header>

