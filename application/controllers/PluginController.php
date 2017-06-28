<?php
namespace application\controllers;

use application\base\WebController;
use plugins\UEditor\UploadAction;
use plugins\Uploader\UploaderAction;

class PluginController extends WebController
{
    public $enableCsrfValidation = FALSE;

    public function actions()
    {
        return [
            'uploader' => [
                'class' => UploaderAction::className(),
            ],
            'ueditor'  => [
                'class' => UploadAction::className(),
            ],
        ];
    }
}
