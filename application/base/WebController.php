<?php
namespace application\base;


use common\extend\ErrorAction;
use yii\web\Controller;

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