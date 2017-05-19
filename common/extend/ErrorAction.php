<?php
namespace common\extend;


class ErrorAction extends \yii\web\ErrorAction
{
    public $view = "/error";

    protected function renderHtmlResponse()
    {
        return $this->controller->renderPartial($this->view ?: $this->id, $this->getViewRenderParams());
    }
}