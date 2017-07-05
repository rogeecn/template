<?php
namespace application\widgets;


use common\base\Widget;

class ContentSummaryItem extends Widget
{
    public $template = "<div class='content-summary'><h2>{title}</h2>{image}{description}<div>{author}{publish_at}{view_cnt}{comment_cnt}</div></div>";
    public $dataProvider;

    public function init()
    {
        foreach ($this->dataProvider as $key => $value) {
            $this->template = str_replace(sprintf("{%s}", $key), $value, $this->template);
        }
    }

    public function run()
    {
        return $this->template;
    }
}