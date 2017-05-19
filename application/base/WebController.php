<?php
namespace application\base;


use common\extend\ErrorAction;
use yii\web\Controller;

class WebController extends Controller
{
    public function beforeAction($action)
    {

        $themeName = $this->getView()->setting("site.theme")?:"basic";
        echo $themeName ;exit;

        $theme = \Yii::$app->getView()->theme;
        $theme->setBasePath("@themes/" . $themeName);
        $theme->pathMap = [
            '@application/views'   => '@themes/' . $themeName,
            '@application/modules' => '@themes/' . $themeName . '/modules',
        ];

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