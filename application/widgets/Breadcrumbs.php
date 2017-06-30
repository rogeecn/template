<?php
namespace application\widgets;


use common\base\Widget;
use common\extend\Html;
use common\models\Category;

class Breadcrumbs extends Widget
{
    public $showIndex = TRUE;
    /**
     * [
     *      ['label'=>'xxx','url'=>xxx],
     *      ['label'=>'xxx','url'=>xxx],
     *      ['label'=>'xxx','url'=>xxx],
     *      'text',
     * ]
     *
     * @var array
     */
    public $linkList   = [];
    public $categoryID = 0;
    public $splitChar  = '&raquo;';
    public $options    = ['class' => 'breadcrumbs'];

    private $linkData = [];

    public function init()
    {
        if ($this->showIndex) {
            $this->linkData[] = Html::a(Html::icon("home", "&nbsp") . "首页", ['/']);
        }

        if ($this->categoryID > 0) {
            $breadList = Category::breadCrumb($this->categoryID);

            foreach ($breadList as $breadItem) {
                $url              = $this->getView()->categoryURL($breadItem['alias']);
                $this->linkData[] = Html::a($breadItem['name'], $url);
            }
        }

        if (!empty($this->linkList)) {

            foreach ($this->linkList as $linkItem) {
                if (is_string($linkItem)) {
                    $this->linkData[] = Html::tag("span", $linkItem);
                    continue;
                }

                $this->linkData[] = Html::a($linkItem['label'], $linkItem['url']);
            }
        }
    }

    public function run()
    {
        $splitHtml = Html::tag("span", $this->splitChar, ['class' => 'split']);

        return Html::div(implode($splitHtml, $this->linkData), $this->options);
    }
}