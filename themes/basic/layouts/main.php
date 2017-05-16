<?php

/* @var $this \yii\web\View */
/* @var $content string */

use application\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>YCms</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<header class="nav">
    <div class="container">
        <div class="nav-sub text-right">
            <ul>
                <li><a href="">联系大前端</a></li>
                <li><a href="">联系大前端</a></li>
                <li><a href="">联系大前端</a></li>
                <li><a href="">联系大前端</a></li>
                <li><a href="">联系大前端</a></li>
            </ul>
        </div>

        <div class="nav-main text-right">
            <h1 class="logo">
                <a href="/">
                    <img src="http://www.daqianduan.com/wp-content/uploads/2015/01/logo.png">
                    大前端
                </a>
            </h1>
            <div class="brand">
                关注前端开发<br>关注用户体验
            </div>

            <ul class="nav-menu">
                <li><a href="">首页</a></li>
                <li><a href="">前端开发</a></li>
                <li><a href="">设计</a></li>
                <li><a href="">前端网址导航</a></li>
                <li><a href="">前端招聘</a></li>
                <li><a href="">WordPress主题</a></li>
            </ul>
        </div>
    </div>
</header>
<section class="container site-body">
    <div class="content">
        <?= $content ?>
    </div>

    <aside class="sidebar">
        <div class="widget border tab-show">
            <ul class="tab-nav">
                <li class="active">网站公告</li>
                <li>最新发布</li>
            </ul>
            <ul class="tab-body">
                <li>
                    <ul class="list">
                        <li><time>2017-02-02</time><a href="">UX Wordpress主题是大前端当前使用主题，是大前端积累多年Wordpress主题经验设计而</a></li>
                        <li><time>2017-02-02</time><a href="">UX Wordpress主题是大前端当前使用主题，是大前端积累多年Wordpress主题经验设计而</a></li>
                        <li><time>2017-02-02</time><a href="">UX Wordpress主题是大前端当前使用主题，是大前端积累多年Wordpress主题经验设计而</a></li>
                        <li><time>2017-02-02</time><a href="">UX Wordpress主题是大前端当前使用主题，是大前端积累多年Wordpress主题经验设计而</a></li>
                        <li><time>2017-02-02</time><a href="">UX Wordpress主题是大前端当前使用主题，是大前端积累多年Wordpress主题经验设计而</a></li>
                    </ul>
                </li>
            </ul>
        </div>


        <div class="widget">
            <div class="block-show style01">
                <div class="band">吐血推荐</div>
                <div class="title">DUX主题 新一代主题</div>
                <div class="info">DUX Wordpress主题是大前端当前使用主题，是大前端积累多年Wordpress主题经验设计而成；更加扁平的风格和干净白色的架构会让网站显得内涵而出色...</div>
            </div>
        </div>

        <div class="widget">
            <div class="block-show style02">
                <div class="band">吐血推荐</div>
                <div class="title">DUX主题 新一代主题</div>
                <div class="info">DUX Wordpress主题是大前端当前使用主题，是大前端积累多年Wordpress主题经验设计而成；更加扁平的风格和干净白色的架构会让网站显得内涵而出色...</div>
            </div>
        </div>


        <div class="widget border">
            <div class="tag-cloud">
                <h3 class="title">标签云</h3>
                <ul class="body">
                  <li>
                      <a href="http://www.daqianduan.com/tag/jobs">招聘/求职 (110)</a>
                  </li>
                    <li>
                        <a href="http://www.daqianduan.com/tag/jobs">招聘/求职 (110)</a>
                    </li>
                    <li>
                        <a href="http://www.daqianduan.com/tag/jobs">招聘/求职 (110)</a>
                    </li>
                    <li>
                        <a href="http://www.daqianduan.com/tag/jobs">招聘/求职 (110)</a>
                    </li>
                    <li>
                        <a href="http://www.daqianduan.com/tag/jobs">招聘/求职 (110)</a>
                    </li>
                    <li>
                        <a href="http://www.daqianduan.com/tag/jobs">招聘/求职 (110)</a>
                    </li>
                    <li>
                        <a href="http://www.daqianduan.com/tag/jobs">招聘/求职 (110)</a>
                    </li>
                    <li>
                        <a href="http://www.daqianduan.com/tag/jobs">招聘/求职 (110)</a>
                    </li>
                    <li>
                        <a href="http://www.daqianduan.com/tag/jobs">招聘/求职 (110)</a>
                    </li>
                    <li>
                        <a href="http://www.daqianduan.com/tag/jobs">招聘/求职 (110)</a>
                    </li>
                    <li>
                        <a href="http://www.daqianduan.com/tag/jobs">招聘/求职 (110)</a>
                    </li>
                </ul>
            </div>
        </div>

    </aside>
</section>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
