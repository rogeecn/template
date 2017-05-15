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
        <div class="carousel">
            <img src="http://www.daqianduan.com/wp-content/uploads/2014/11/hs-xiu.jpg" alt="">
        </div>

        <article class="announcement">
            <h3 class="title"><a href="">滴滴出行(杭州)招聘资深前端开发工程师</a></h3>
            <p class="info">滴滴出行杭州团队，支持代驾及专车业务。 岗位职责： 独立负责承担一个子业务的前端设计与开发工作 建设与维护团队前端工程化及服务化体系 任职要求：
                精通各种前端技术，对技术底层、原生JS、浏览器机制有深刻理解 有基于Node的全栈开发经验，对...</p>
        </article>

        <div class="title">
            <h3>最新发布</h3>
            <div class="more">
                <a href="">themebetter 国内更好的WordPress主题服务商</a>
            </div>
        </div>

        <article class="list-item">

        </article>
    </div>

    <aside class="sidebar">
        asdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdf
    </aside>
</section>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
