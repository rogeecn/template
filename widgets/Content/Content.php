<?php
namespace widgets\Content;


use common\base\Widget;

class Content extends Widget
{
    public $title       = "";
    public $meta        = [];
    public $content     = [];
    public $description = "";

    public function run()
    {
        return $this->render("view", [
            'title'       => $this->title,
            'meta'        => $this->meta,
            'content'     => $this->content,
            'description' => $this->description,
        ]);
    }
}