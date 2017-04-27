<?php
namespace application\base;


use yii\web\Controller;
use yii\web\ErrorAction;

class WebController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::className(),
            ],
        ];
    }
}