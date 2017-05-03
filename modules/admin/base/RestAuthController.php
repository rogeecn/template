<?php
namespace modules\admin\base;


use common\extend\ContentNegotiator;
use yii\rest\Controller;
use yii\web\Response;

class RestAuthController extends Controller
{
    use TraitAuthAction;

    public function behaviors() {
        return [
            'contentNegotiator' => [
                'class'   => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }
}