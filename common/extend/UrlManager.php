<?php
namespace common\extend;


use common\models\Category;
use yii\web\UrlNormalizer;

class UrlManager extends \yii\web\UrlManager
{
    public $enablePrettyUrl = TRUE;
    public $showScriptName  = FALSE;
    /** @var UrlNormalizer */
    public $normalizer = [
        'class'                  => 'yii\web\UrlNormalizer',
        'collapseSlashes'        => TRUE,
        'normalizeTrailingSlash' => TRUE,
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
        $this->rules['/'] = 'index/index';

        //article for id
        $key               = sprintf('%s/<id:\d+>', $articlePath);
        $this->rules[$key] = 'article/id';

        //article for alias
        $key               = sprintf('%s/<alias:[\w|\-|_]+>', $articlePath);
        $this->rules[$key] = 'article/alias';

        // tag with pager
//        $key               = sprintf('%s/<name:(.*?)>/page-<page:\d+>', $tagPath);
//        $this->rules[$key] = 'tag/index';

        //tag
        $key               = sprintf('%s/<name:(.*?)>', $tagPath);
        $this->rules[$key] = 'tag/index';


        /** @var Category[] $allCategory */
        $allCategory = Category::find()->all();
        foreach ($allCategory as $category) {
//                $pageKey = sprintf('<alias:%s>/page-<page:\d+>', $categoryPath, $category->alias);
            $key = sprintf("<alias:%s>", $category->alias);
            if (!empty($categoryPath)) {
//                $pageKey = sprintf('%s/<alias:%s>/page-<page:\d+>', $categoryPath, $category->alias);
                $key = sprintf("%s/<alias:%s>", $categoryPath, $category->alias);
            }

//            $this->rules[$pageKey] = 'category/index';
            $this->rules[$key] = 'category/index';
        }

        parent::init();
    }
}