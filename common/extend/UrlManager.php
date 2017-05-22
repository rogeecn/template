<?php
namespace common\extend;


use common\models\Category;
use yii\web\UrlNormalizer;

class UrlManager extends \yii\web\UrlManager
{
    public $enablePrettyUrl = true;
    public $showScriptName  = false;
    /** @var UrlNormalizer */
    public $normalizer = [
        'class'                  => 'yii\web\UrlNormalizer',
        'collapseSlashes'        => true,
        'normalizeTrailingSlash' => true,
    ];

    public function init()
    {
        $articlePath = \Yii::$app->getView()->setting("path.article");
        if (!$articlePath) {
            $articlePath = 'read';
        }

        $categoryPath = \Yii::$app->getView()->setting("path.category");
        if (!$categoryPath) {
            $categoryPath = '';
        }

        $tagPath = \Yii::$app->getView()->setting("path.tag");
        if (!$tagPath) {
            $tagPath = '';
        }

        //article for id
        $key               = sprintf('%s/<id:\d+>', $articlePath);
        $this->rules[$key] = 'article/id';

        //article for alias
        $key               = sprintf('%s/<alias:[\w|\-|_]+>', $articlePath);
        $this->rules[$key] = 'article/alias';

        //tag
        $key               = sprintf('%s/<name:(.*?)>', $tagPath);
        $this->rules[$key] = 'tag/index';

        /** @var Category[] $allCategory */
        $allCategory = Category::find()->all();
        foreach ($allCategory as $category) {
            if (!empty($categoryPath)) {
                $key = sprintf("/%s/<alias:%s>", $categoryPath, $category->alias);
            } else {
                $key = sprintf("/<alias:%s>", $category->alias);
            }

            $this->rules[$key] = 'category/index';
        }

        parent::init();
    }
}