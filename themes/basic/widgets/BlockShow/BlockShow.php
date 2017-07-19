<?php
namespace themes\basic\widgets\BlockShow;


use common\base\Widget;
use common\models\Article;
use common\extend\Html;
use yii\base\InvalidParamException;

class BlockShow extends Widget
{
    public $id = '';

    private $style   = 'style01';
    private $tag     = '';
    private $title   = '';
    private $content = '';

    public function init()
    {
        if (empty($this->id)) {
            throw new InvalidParamException("missing param id");
        }

        $data = Article::getDataByID($this->id);

        $this->style   = $data['fields']['content_link']['style'];
        $this->tag     = $data['fields']['content_link']['tag'];
        $this->title   = $data['title'];
        $this->content = $data['fields']['content_link']['content'];
    }

    public function run()
    {
        $tagOptions = [];
        Html::addCssClass($tagOptions, ['widget', 'block-show', $this->style]);

        $content = "";
        $content .= Html::beginTag('a', $tagOptions);
        $content .= Html::tag("div", $this->tag, ['class' => 'band']);
        $content .= Html::tag("div", $this->title, ['class' => 'title']);
        $content .= Html::tag("div", $this->content, ['class' => 'info']);
        $content .= Html::endTag("a");

        return $content;
    }
}