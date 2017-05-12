<?php
namespace modules\fex\widget;


use modules\fex\assets\FexAssets;
use yii\base\InvalidParamException;
use yii\base\Widget;
use yii\web\AssetBundle;
use yii\widgets\InputWidget;

class FexUploader extends InputWidget
{
    /** @var  AssetBundle */
    private $asset ;

    public $picker = "";

    public function init()
    {
        if (empty($this->picker)){
            throw new InvalidParamException("picker required");
        }
        $this->asset = FexAssets::register($this->getView())    ;
    }

    public function run()
    {
        $this->getView()->registerJs($this->getJs());
    }

    private function getJs()
    {
        return $JS  = <<<_JS_
var uploader = WebUploader.create({

    auto:true,
    paste: document.body,
    dnd: document.body,
    runtimeOrder : "html5",
    
    // swf文件路径
    swf: '{$this->asset->baseUrl}/js/Uploader.swf',

    // 文件接收服务端。
    server: '/fex/upload',

    // 选择文件的按钮。可选。
    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
    pick: '{$this->picker}',

    // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
    resize: false,
    
       // 只允许选择图片文件。
    accept: {
        title: 'Images',
        extensions: 'gif,jpg,jpeg,bmp,png',
        mimeTypes: 'image/*'
    }
});

// 当有文件添加进来的时候
uploader.on( 'fileQueued', function( file ) {
    var li = $(
            '<div id="' + file.id + '" class="file-item thumbnail">' +
                '<img>' +
                '<div class="info">' + file.name + '</div>' +
            '</div>'
            ),
        img = li.find('img');


    //$ list为容器jQuery实例
    $("#st").append( li );

    // 创建缩略图
    // 如果为非图片文件，可以不用调用此方法。
    // thumbnailWidth x thumbnailHeight 为 100 x 100
    uploader.makeThumb( file, function( error, src ) {
        if ( error ) {
            img.replaceWith('<span>不能预览</span>');
            return;
        }

        img.attr( 'src', src );
    }, thumbnailWidth, thumbnailHeight );
});


// 文件上传过程中创建进度条实时显示。
uploader.on( 'uploadProgress', function( file, percentage ) {
    var li = $( '#'+file.id ),
        percent = li.find('.progress span');

    // 避免重复创建
    if ( !percent.length ) {
        percent = $('<p class="progress"><span></span></p>')
                .appendTo( li )
                .find('span');
    }

    percent.css( 'width', percentage * 100 + '%' );
});

// 文件上传成功，给item添加成功class, 用样式标记上传成功。
uploader.on( 'uploadSuccess', function( file ) {
    $( '#'+file.id ).addClass('upload-state-done');
});

// 文件上传失败，显示上传出错。
uploader.on( 'uploadError', function( file ) {
    var li = $( '#'+file.id ),
        error = li.find('div.error');

    // 避免重复创建
    if ( !error.length ) {
        error = $('<div class="error"></div>').appendTo(li );
    }

    error.text('上传失败');
});

// 完成上传完了，成功或者失败，先删除进度条。
uploader.on( 'uploadComplete', function( file ) {
    $( '#'+file.id ).find('.progress').remove();
});
_JS_;

    }
}