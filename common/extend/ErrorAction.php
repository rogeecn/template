<?php
namespace common\extend;


class ErrorAction extends \yii\web\ErrorAction
{
    protected function renderHtmlResponse()
    {
        return $this->controller->renderPartial($this->view ?: $this->id, $this->getViewRenderParams());
    }
}