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

        //article for id
        $key               = sprintf('%s/<id:\d+>', $articlePath);
        $this->rules[$key] = 'article/id';

        //article for alias
        $key               = sprintf('%s/<alias:[\w|\-|_]+>', $articlePath);
        $this->rules[$key] = 'article/alias';

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