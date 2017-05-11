<?php
namespace common\extend;


class Theme extends \yii\base\Theme
{
    public function setTheme($themeName) {
        $this->setBasePath( sprintf("@themes/%s", $themeName));
    }
}