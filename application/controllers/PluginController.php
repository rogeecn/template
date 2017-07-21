<?php
namespace application\controllers;

use application\base\WebController;
use plugins\UEditor\UploadAction;
use plugins\Uploader\UploaderAction;

class PluginController extends WebController
{
    public $enableCsrfValidation = false;

    public function actions()
    {
        return [
            'uploader'       => [
                'class' => UploaderAction::className(),
            ],
            'ueditor'        => [
                'class' => UploadAction::className(),
            ],
            'tinymce_upload' => [
                'class' => \plugins\TinyMCE\UploaderAction::className(),
            ],
        ];
    }
}
