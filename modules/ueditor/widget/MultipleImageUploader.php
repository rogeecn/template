<?php
namespace modules\ueditor\widget;


use modules\ueditor\assets\UEditorAssets;
use yii\bootstrap\Html;
use yii\widgets\InputWidget;

class MultipleImageUploader extends InputWidget
{
    public $limit = 1;
    public static $autoIdPrefix = "insert_image_";

    public function init()
    {
        if ($this->limit < 1){
            $this->limit = 1;
        }
    }

    public function run()
    {
        UEditorAssets::register($this->getView());

        $baseID = self::getId();

        $editor_id = "editor_".$baseID;
        $btn_id = "btn_".$baseID;
        $img_list_wrapper_id = "image_wrapper_".$baseID;

        $js = <<<_UEDITOR_
var $editor_id = UE.getEditor("$editor_id", {
        isShow: false,
        focus: false,
        enableAutoSave: false,
        autoSyncData: false,
        autoFloatEnabled:false,
        wordCount: false,
        sourceEditor: null,
        scaleEnabled:true,
        toolbars: [["insertimage"]]
    });
    
    $editor_id.ready(function () {
        // 监听插入图片
        $editor_id.addListener("beforeInsertImage", _beforeInsertImage);
        // 监听插入附件
        // uploadEditor.addListener("afterUpfile",_afterUpfile);
    });

    document.getElementById('$btn_id').onclick = function () {
        var dialog = $editor_id.getDialog("insertimage");
        dialog.title = '多图上传';
        dialog.render();
        dialog.open();
    };

    function _beforeInsertImage(t, result) {
        var imageHtml = '';
        if ($this->limit == 1 && result.length > 0){
            
            imageHtml += '<img src="'+result[0].src+'" width="100%" height="100%">';
            document.getElementById('$btn_id').innerHTML = imageHtml;
            return ;
        }
        
        for(var i in result){
            imageHtml += '<li><img src="'+result[i].src+'" width="100%" height="100%"></li>';
        }
        document.getElementById('$img_list_wrapper_id').innerHTML = imageHtml;
    }
_UEDITOR_;
        $this->getView()->registerJs($js);

        echo Html::button("Upload",['id'=>$btn_id,'class'=>'insert-image-btn']);

        echo Html::textarea("","",['id'=>$editor_id,'style'=>'display:none']);
        if ($this->limit > 1){
            echo Html::tag("ul","",['id'=>$img_list_wrapper_id,'class'=>'upload-image-list-wrapper']);
        }
    }
}