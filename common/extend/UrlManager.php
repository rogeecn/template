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
        /** @var Category[] $allCategory */
        $allCategory = Category::find()->all();
        foreach ($allCategory as $category) {
            $key               = sprintf("/<alias:%s>", $category->alias);
            $this->rules[$key] = 'category/index';
        }

        parent::init();
    }
}