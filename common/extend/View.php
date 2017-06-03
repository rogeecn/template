<?php
namespace common\extend;


use yii\helpers\Url;

class View extends \yii\web\View
{
    use \common\traits\Setting;

    private $keywords;
    private $description;
    private $adminMode = false;

    public function setAdminMode()
    {
        $this->adminMode = true;
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
        if ($this->adminMode) {
            parent::head();

            return;
        }

        $title = $this->setting("site.name");
        if (!empty($this->title)) {
            $title = sprintf("%s - %s", $this->title, $title);
        }

        if ($slogan = $this->setting("site.slogan")) {
            $title = sprintf("%s - %s", $title, $slogan);
        }
        echo Html::tag("title", $title);
        echo "\n";

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

        echo "\n";
        echo $this->setting("site.code_top");
    }

    public function endBody()
    {
        parent::endBody();
        if ($this->adminMode) {
            return;
        }

        echo "\n";
        echo $this->setting("site.code_bottom");
    }

    public function categoryURL($alias)
    {
        return Url::toRoute(['/category/index', 'alias' => $alias]);
    }


    public function articleAliasURL($alias)
    {
        return Url::to(['/article/alias', 'alias' => $alias]);
    }

    public function articleIDURL($id)
    {
        return Url::to(['/article/id', 'id' => $id]);
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