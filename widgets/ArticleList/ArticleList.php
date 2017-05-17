<?php
namespace widgets\ArticleList;


use common\base\Widget;

class ArticleList extends Widget
{
    /**
     * [
     *  'label'=>'',
     *  'url'=>'',
     * ]
     * @var array
     */
    public $category = [];
    /**
     * [
     *  label=>'',
     *  url=>'',
     * ]
     * @var array
     */
    public $title = [];

    /** @var string */
    public $content = "";

    public function run() {
        return $this->render("view", [
            'title'    => $this->title,
            'category' => $this->category,
            'content'  => $this->content,
        ]);
    }
}