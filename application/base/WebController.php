<?php
namespace application\base;


use common\extend\ErrorAction;
use yii\web\Controller;

class WebController extends Controller
{
    use TraitThemeSet;

    public function beforeAction($action)
    {
        $this->setTheme();

        return parent::beforeAction($action);
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::className(),
            ],
        ];
    }
}