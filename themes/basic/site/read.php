<div class="page-article">

    <div class="article">
        <header><h1>判断单、多张图片加载完成</h1></header>

        <div class="meta">
            <span>2017-04-03</span>
            <span>评论(5)</span>
            <span>分类：<a href="">JavaScript</a> / <a href="">技巧资源</a></span>
            <span>阅读(5451)</span>
        </div>

        <article class="content-data">
            <p>在实际的运用中有这样一种场景，某资源加载完成后再执行某个操作，例如在做导出时，后端通过打开模板页生成PDF，并返回下载地址。这时前后端通常需要约定一个flag，用以标识模板准备就绪，可以生成PDF了。</p>
            <p>试想，如果模板中有图片，此时如何判断图片是否加载完成？</p>
            <p>
                在此之前来了解一下jquery的ready与window.onload的区别，ready只是dom结构加载完毕，便视为加载完成。(此时图片没有加载完毕)，onload是指dom的生成和资源完全加载（比如flash、图片）出来后才执行。接下来回到正题，先从单张图片说起。</p>
            <p>（1）、单张图片（图片在文档中）</p>
            <pre>// HTML
&lt;img id='xiu' src="http://www.daqianduan.com/wp-content/uploads/2014/11/hs-xiu.jpg"&gt;

//js
 $(document).ready(function(){

    //jquery
    $('#xiu').load(function(){
       // 加载完成
    });

   //原生  onload
    var xiu = document.getElementById('xiu')
    xiu.onload = xiu.onreadystatechange = function(){
       if(!this.readyState||this.readyState=='loaded'||this.readyState=='complete'){
           // 加载完成
       }
    };

})</pre>
            <p>注：<br/>
                1、IE8及以下版本不支持onload事件，但支持onreadystatechange事件；<br/>
                2、readyState是onreadystatechange事件的一个状态，值为loaded或complete的时候，表示已经加载完毕。<br/>
                3、以下内容省略兼容</p>
            <p>（2）、单张图片（图片动态生成）</p>
            <pre>//js
 var xiu = new Image()
 xiu.src = 'http://www.daqianduan.com/wp-content/uploads/2014/11/hs-xiu.jpg'
 xiu.onload = function(){
    // 加载完成
 }</pre>
            <p>（3）、单张图片（结合ES6 Promise）</p>
            <pre>//js
 new Promise((resolve, reject)=&gt;{
    let xiu = new Image()
    xiu.src = 'http://www.daqianduan.com/wp-content/uploads/2014/11/hs-xiu.jpg'
    xiu.onload = function(){
       // 加载完成
       resolve(xiu)
    }
 }).then((xiu)=&gt;{
 //code
 })</pre>
            <p>（4）、多张图片</p>
            <pre>var img = [],
    flag = 0,
    mulitImg = [
    'http://www.daqianduan.com/wp-content/uploads/2017/03/IMG_0119.jpg',
    'http://www.daqianduan.com/wp-content/uploads/2017/01/1.jpg',
    'http://www.daqianduan.com/wp-content/uploads/2015/11/jquery.jpg',
    'http://www.daqianduan.com/wp-content/uploads/2015/10/maid.jpg'
 ];
 var imgTotal = mulitImg.length;
 for(var i = 0 ; i &lt; imgTotal ; i++){
    img[i] = new Image()
    img[i].src = mulitImg[i]
    img[i].onload = function(){
       //第i张图片加载完成
       flag++
       if( flag == imgTotal ){
          //全部加载完成
       }
    }
 }</pre>
            <p>（5）、多张图片（结合ES6 Promise.all()）</p>
            <pre>  let mulitImg = [
     'http://www.daqianduan.com/wp-content/uploads/2017/03/IMG_0119.jpg',
     'http://www.daqianduan.com/wp-content/uploads/2017/01/1.jpg',
     'http://www.daqianduan.com/wp-content/uploads/2015/11/jquery.jpg',
     'http://www.daqianduan.com/wp-content/uploads/2015/10/maid.jpg'
 ];
 let promiseAll = [], img = [], imgTotal = mulitImg.length;
 for(let i = 0 ; i &lt; imgTotal ; i++){
     promiseAll[i] = new Promise((resolve, reject)=&gt;{
         img[i] = new Image()
         img[i].src = mulitImg[i]
         img[i].onload = function(){
              //第i张加载完成
              resolve(img[i])
         }
     })
 }
 Promise.all(promiseAll).then((img)=&gt;{
     //全部加载完成
 })</pre>
        </article>
    </div>

    <div class="post-copyright">未经允许不得转载：<a href="http://www.daqianduan.com">大前端</a> » <a href="http://www.daqianduan.com/6419.html">判断单、多张图片加载完成</a></div>

    <div class="post-author">
        <div class="head">
            <img src="https://secure.gravatar.com/avatar/fbe1c43581600c6a1e6c3de93321f7e8?s=100&d=mm" alt="">
        </div>
        <div class="author-info">
            <span class="name"><i class="fa fa-user"></i>&nbsp;<strong>GoMan</strong></span>
            <p class="signature">我就是我，颜色不一样的火</p>
        </div>
    </div>

    <div class="post-recommend">
        <div class="title">相关推荐</div>
        <ul>
            <li><i>-</i><a href="">图表库–ECharts</a></li>
            <li><i>-</i><a href="">图表库–ECharts</a></li>
            <li><i>-</i><a href="">图表库–ECharts</a></li>
            <li><i>-</i><a href="">图表库–ECharts</a></li>
            <li><i>-</i><a href="">图表库–ECharts</a></li>
            <li><i>-</i><a href="">图表库–ECharts</a></li>
            <li><i>-</i><a href="">图表库–ECharts</a></li>
            <li><i>-</i><a href="">图表库–ECharts</a></li>
        </ul>
    </div>
</div>
