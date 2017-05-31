<?php
namespace common\extend;


use common\models\Setting;
use yii\helpers\FileHelper;
use yii\helpers\Url;

class View extends \yii\web\View
{
    private static $_SETTING;
    private        $keywords;
    private        $description;

    // site.name 点连接格式
    public function setting($configPath)
    {
        $settingCacheFile = \Yii::getAlias("@runtime/data/setting.php");
        if (empty(self::$_SETTING)) {
            if (!is_file($settingCacheFile)) {
                if (!is_dir(dirname($settingCacheFile))) {
                    FileHelper::createDirectory(dirname($settingCacheFile));
                }
                self::$_SETTING = Setting::flatSettings();
                file_put_contents($settingCacheFile, json_encode(self::$_SETTING));
            } else {
                self::$_SETTING = json_decode(file_get_contents($settingCacheFile), true);
            }
        }

        if (!isset(self::$_SETTING[$configPath])) {
            return false;
        }

        return self::$_SETTING[$configPath];
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function appendTitle($title, $seperator = '-')
    {
        $this->title = sprintf("%s %s %s", $title, $seperator, $this->title);
    }

    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    public function setDescription($description)
    {
        $this->description = $description;
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
        $defaultKeywords = $this->setting('site.keyword');
        $this->registerMetaTag([
            'name'    => 'keyword',
            'content' => empty($this->keywords) ? $defaultKeywords : $this->keywords,
        ], 'keyword');

        //register description
        $defaultDescription = $this->setting('site.description');
        $this->registerMetaTag([
            'name'    => 'description',
            'content' => empty($this->description) ? $defaultDescription : $this->description,
        ], 'description');

        parent::head();

        echo $this->setting("site.code_top");
    }

    public function endBody()
    {
        parent::endBody();
        echo $this->setting("site.code_bottom");
    }

    public function categoryURL($alias)
    {
        return Url::toRoute(['/category/index', 'alias' => $alias]);
    }


    public function articleAliasURL($alias)
    {
        return Url::toRoute(['/article/alias', 'alias' => $alias]);
    }

    public function articleIDURL($id)
    {
        return Url::toRoute(['/article/id', 'id' => $id]);
    }

    public function ICPNumber()
    {
        $ICPNumber = $this->setting("site.icp_number");
        if (!empty($ICPNumber)) {
            return Html::a($ICPNumber, "http://www.miitbeian.gov.cn/");
        }

        return "";
    }

    public function PoliceNumber()
    {
        $PoliceNumber = $this->setting("site.police_number");
        if (!empty($PoliceNumber)) {
            return Html::a($PoliceNumber, "#");
        }

        return "";
    }
}