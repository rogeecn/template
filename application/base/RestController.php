<?php
namespace application\base;


use common\extend\ContentNegotiator;
use common\traits\Setting;
use yii\rest\Controller;
use yii\web\ErrorAction;
use yii\web\Response;

class RestController extends Controller
{
    use Setting;

    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::className(),
            ],
        ];
    }

    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class'   => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        return parent::beforeAction($action);
    }
}