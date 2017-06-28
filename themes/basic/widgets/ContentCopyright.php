<?php
namespace themes\basic\widgets;


use common\base\Widget;
use common\extend\Html;
use common\extend\View;
use common\models\Article;
use yii\web\NotFoundHttpException;

class ContentCopyright extends Widget
{
    public $articleID = [];

    public function run()
    {
        $articleData = self::getCache('article_' . $this->articleID);
        if (!$articleData) {
            $articleData = Article::getDataByID($this->articleID);
            if (!$articleData) {
                throw new NotFoundHttpException();
            }
        }
        self::setCache("article_" . $this->articleID, $articleData);

        /** @var View $view */
        $view        = $this->getView();
        $siteLink    = Html::a($view->setting("site.name"), $view->setting("site.url"));
        $articleLink = Html::a($articleData['title'], ['article/id', 'id' => $this->articleID]);

        $content = sprintf('未经允许不得转载：%s » %s', $siteLink, $articleLink);

        return Html::div($content, ['class' => 'post-copyright']);
    }
}