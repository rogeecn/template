<?php
namespace common\base;


use common\extend\View;

class Widget extends \yii\base\Widget
{
    /** @var  View */
    protected $view;

    public function init()
    {
        $this->view = $this->getView();
        parent::init();
    }
}