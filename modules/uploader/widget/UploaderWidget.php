<?php
namespace modules\uploader\widget;


use plugins\LayUI\components\Html;
use plugins\LayUI\LayUIAssets;
use yii\widgets\InputWidget;

class UploaderWidget extends InputWidget
{
    public $action = "/uploader/upload";

    /**
     * @var array
     * - limitCount
     * -
     */
    public $options        = [];
    public $defaultOptions = [
        'limitCount'      => 1,
        'fileType'        => 'images',  // images,file,video,audio
        'showText'        => "Upload",
        'handleSuccess'   => '',
        //返回的参数item，即为当前的input DOM对象
        'handleBefore'    => '',//function(input){console.log("文件上传中");}
        'validExtensions' => ['jpg', 'jpeg', 'png', 'bmp', 'gif'],
    ];

    public $template = "<ul class='image-upload'><li>{input}</li>\n{image}</ul>";


    public function init()
    {
        $this->defaultOptions['sourceURL'] = $this->getView()->setting("site.static_path");
        $this->options                     = array_merge($this->defaultOptions, $this->options);
        LayUIAssets::register($this->getView());
        $this->getView()->registerJs($this->getJs());
        $this->getView()->registerCss($this->getCSS());

    }

    public function run()
    {

        if (!isset($this->options['id'])) {
            $this->options['id'] = self::getId();
        }

        $options['lay-ext']   = implode("|", $this->options['validExtensions']);
        $options['lay-type']  = $this->options['fileType'];
        $options['lay-title'] = $this->options['showText'];
        $options['class']     = "layui-upload-file";

        $fileInput = Html::fileInput('ajax-file-upload', "", $options);

        $imageList = is_array($this->value) ? $this->value : explode(",", $this->value);
        $imageList = array_filter($imageList);

        $liList = [];
        foreach ($imageList as $image) {
            if (strpos($image, "http") === 0) {
                $imageURL = $image;
            } elseif (strpos($image, "//") === 0) {
                $imageURL = $image;
            } else {
                $imageURL = $this->options['sourceURL'] . ltrim($image, "/");
            }
            $removeBtn = Html::tag("span", "删除", ['class' => ['remove']]);
            $image     = Html::img($imageURL);
            $input     = Html::hiddenInput($this->name . "[]", $imageURL);
            $liList[]  = Html::tag("li", $removeBtn . $image . $input);
        }

        return strtr($this->template, [
            "{input}" => $fileInput,
            "{image}" => implode("\n", $liList),
        ]);
    }

    private function getJs()
    {
        if (empty($this->options['handleSuccess'])) {
            $this->options['handleSuccess'] = <<<_JS_SUCCESS_
function(res, input){
    var _html_tpl = '<li>';
    _html_tpl += '<span class="remove">删除</span>';
    _html_tpl += '<img src="{$this->options['sourceURL']}_IMG_PATH_"/>';
    _html_tpl += '<input type=hidden name="{$this->name}[]" value="{$this->options['sourceURL']}_IMG_PATH_"/>';
    _html_tpl += '</li>';
    
    
    console.log(res); 
    var html = _html_tpl.replace("_IMG_PATH_",res.data.path)
    html = html.replace("_IMG_PATH_",res.data.path)
    $(".image-upload").append(html);
}
_JS_SUCCESS_;
        }

        // 必须返回true/false 要不不会上传的。
        if (empty($this->options['handleBefore'])) {
            $this->options['handleBefore'] = <<<_JS_BEOFRE_
function(input){
    if (($(".image-upload>li").length -1)>={$this->options['limitCount']}){
        alert("上传数量超出限制: "+{$this->options['limitCount']});
        return false;
    }
    return true;
}
_JS_BEOFRE_;

        }


        $js = <<<_JS_
var SOURCE_URL = "{$this->options['sourceURL']}";
layui.upload({
  url: '{$this->action}'
  ,before: {$this->options['handleBefore']}
  ,success: {$this->options['handleSuccess']}
}); 

$("body").on("click","ul.image-upload span.remove",function(data){
    if (!confirm("确认删除图片么?")){
         return;
    }
    
    $(this).closest("li").remove();
});
_JS_;

        return $js;
    }

    private function getCSS()
    {
        $css = <<<_CSS
    ul.image-upload{
        border: 1px solid #e6e6e6;
    }
    ul.image-upload > li {
        display: inline-block;
        position: relative;
        padding: 10px;
        width: 100px;
        height: 100px;
    }

    ul.image-upload > li img {
        width: 100%;
        height: 100%;
    }

    ul.image-upload > li .layui-upload-button {
        width: 100%;
        height: 100%;
    }
    
    ul.image-upload > li .remove {
        position: absolute;
        bottom: 11px;
        background: #ff5722;
        display: block;
        width: 100px;
        height: 20px;
        line-height: 20px;
        font-size: 12px;
        text-align: center;
        color: white;
        cursor: pointer;
    }
_CSS;

        return $css;
    }
}