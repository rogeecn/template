<?php
namespace common\extend;


use common\models\Setting;
use yii\helpers\FileHelper;
use yii\helpers\Url;

class View extends \yii\web\View
{
    private static $_SETTING;

    // site.name 点连接格式
    public function setting($configPath)
    {
        $settingCacheFile = \Yii::getAlias("@runtime/data/setting.php");
        if (empty(selF::$_SETTING)) {
            if (!is_file($settingCacheFile)) {
                if (!is_dir(dirname($settingCacheFile))) {
                    FileHelper::createDirectory(dirname($settingCacheFile));
                }
                self::$_SETTING = Setting::flatSettings();
                file_put_contents($settingCacheFile, json_encode(self::$_SETTING));
            } else {
                self::$_SETTING = json_decode(file_get_contents($settingCacheFile), TRUE);
            }
        }

        if (!isset(self::$_SETTING[$configPath])) {
            return FALSE;
        }

        return self::$_SETTING[$configPath];
    }

    public function head()
    {
        $title = $this->setting("site.name");
        if (!empty($this->title)) {
            $title = sprintf("%s - %s", $this->title, $title);
        }

        if ($slogan = $this->setting("site.slogan")) {
            $title = sprintf("%s - %s", $title, $slogan);
        }
        echo Html::tag("title", $title);

        //register keywords
        $this->registerMetaTag([
            'name'    => 'keywords',
            'content' => $this->setting('site.keywords'),
        ], 'keywords');

        //register description
        $this->registerMetaTag([
            'name'    => 'description',
            'content' => $this->setting('site.description'),
        ], 'description');

        parent::head();

        echo $this->setting("site.code_top");
    }

    public function endBody()
    {
        parent::endBody();
        echo $this->setting("site.code_top");
    }

    public function categoryURL($alias)
    {
        return Url::toRoute(['/category/index', 'alias' => $alias]);
    }
}