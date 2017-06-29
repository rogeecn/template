<?php
namespace plugins\ChangYan;

use common\base\Widget;
use yii\helpers\Html;

class ChangYan extends Widget
{
    public $mode     = "pc";// pc, wap, common
    public $appID    = "";
    public $configID = "";
    public $sourceID = "";

    public function init()
    {

        if ($this->mode == "pc") {

            $pcJS     = "https://changyan.sohu.com/upload/changyan.js";
            $pcScript = <<<_JS_
        window.changyan.api.config({
            appid: '$this->appID',
            conf: '$this->configID'
        });
_JS_;
            $this->getView()->registerJsFile($pcJS);
            $this->getView()->registerJs($pcScript);
        }

        if ($this->mode == "wap") {
            $wapJSTpl = "https://changyan.sohu.com/upload/mobile/wap-js/changyan_mobile.js?client_id=%s&conf=%s";
            $wapJS    = sprintf($wapJSTpl, $this->appID, $this->configID);
            $this->getView()->registerJsFile($wapJS);
        }

        if ($this->mode == "common") {
            $commonScript = <<<_JS_
(function(){ 
var appid = '$this->appID'; 
var conf = '$this->configID'; 
var width = window.innerWidth || document.documentElement.clientWidth; 
if (width < 960) { 
window.document.write('<script id="changyan_mobile_js" charset="utf-8" type="text/javascript" src="https://changyan.sohu.com/upload/mobile/wap-js/changyan_mobile.js?client_id=' + appid + '&conf=' + conf + '"><\/script>'); } else { var loadJs=function(d,a){var c=document.getElementsByTagName("head")[0]||document.head||document.documentElement;var b=document.createElement("script");b.setAttribute("type","text/javascript");b.setAttribute("charset","UTF-8");b.setAttribute("src",d);if(typeof a==="function"){if(window.attachEvent){b.onreadystatechange=function(){var e=b.readyState;if(e==="loaded"||e==="complete"){b.onreadystatechange=null;a()}}}else{b.onload=a}}c.appendChild(b)};loadJs("https://changyan.sohu.com/upload/changyan.js",function(){window.changyan.api.config({appid:appid,conf:conf})}); } })(); 
_JS_;
            $this->getView()->registerJs($commonScript);
        }

    }

    public function run()
    {
        return Html::tag("div", "", [
            'id'  => 'SOHUCS',
            'sid' => $this->sourceID,
        ]);
    }
}