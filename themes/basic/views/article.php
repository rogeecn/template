<?= \widgets\Breadcrumbs::widget(['categoryID' => $categoryID]) ?>
<div class="content">
    <div class="page-article">
        <?= \widgets\Content\Content::widget([
            'articleID' => $articleInfo['id'],
        ]); ?>
    </div>

    <div class="article-comment">
        <div id="cloud-tie-wrapper" class="cloud-tie-wrapper"></div>
        <script src="https://img1.cache.netease.com/f2e/tie/yun/sdk/loader.js"></script>
        <script>
            var cloudTieConfig = {
                url: document.location.href,
                sourceId: "",
                productKey: "2b2378c0dfb14952b03920db583185a8",
                target: "cloud-tie-wrapper"
            };
            var yunManualLoad = true;
            Tie.loader("aHR0cHM6Ly9hcGkuZ2VudGllLjE2My5jb20vcGMvbGl2ZXNjcmlwdC5odG1s", true);
        </script>
    </div>
</div>
<?= $this->render("sider") ?>
