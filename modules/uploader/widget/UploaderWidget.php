<?php
namespace modules\uploader\widget;


use LayUI\components\Html;
use LayUI\LayUIAssets;
use yii\web\AssetBundle;
use yii\widgets\InputWidget;

class UploaderWidget extends InputWidget
{
    /** @var  AssetBundle */
    private $asset;

    public $action = "/uploader/upload";
    // images,file,video,audio
    public $sourceURL = "//tpl.local/uploads/";
    public $fileType  = "images";
    public $showText  = "Upload";

    public $template = "<ul class='image-upload'><li>{input}</li>\n{image}</ul>";

    public $validExtensions = ['jpg', 'jpeg', 'png', 'bmp', 'gif'];

    public $handleSuccess = '';

    //返回的参数item，即为当前的input DOM对象
    public $handleBefore = 'function(input){console.log("文件上传中");}';

    public function init() {
        LayUIAssets::register($this->getView());
    }

    public function run() {
        $this->getView()->registerJs($this->getJs());

        if (!isset($this->options['id'])) {
            $this->options['id'] = self::getId();
        }

        $this->options['lay-ext']   = implode("|", $this->validExtensions);
        $this->options['lay-type']  = $this->fileType;
        $this->options['lay-title'] = $this->showText;
        Html::addCssClass($this->options, "layui-upload-file");

        $fileInput = Html::fileInput('ajax-file-upload', $this->value, $this->options);

        $imageList = is_array($this->value) ? $this->value : explode(",", $this->value);

        $liList = [];
        foreach ($imageList as $image) {
            if (strpos($image, "http") === 0) {
                $image = Html::img($image);
            } else {
                $image = Html::img($this->sourceURL . ltrim($image, "/"));
            }
            $liList[] = Html::tag("li", $image);
        }

        return strtr($this->template, [
            "{input}" => $fileInput,
            "{image}" => implode("\n", $liList),
        ]);
    }

    private function getJs() {
        if (empty($this->handleSuccess)) {
            $this->handleSuccess = <<<_JS_
function(res, input){
    console.log(res); 
    $(".image-upload").append("<li><img src='$this->sourceURL" + res.data.path + "' /></li>");
}
_JS_;
        }
        $js = <<<_JS_
var SOURCE_URL = "$this->sourceURL";
layui.upload({
  url: '{$this->action}'
  ,before: {$this->handleBefore}
  ,success: {$this->handleSuccess}
}); 
_JS_;
        return $js;
    }
}