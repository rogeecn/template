<?php
/**
 * Created by PhpStorm.
 * User: yanghao
 * Date: 2017/5/19
 * Time: 11:20
 */

namespace application\base;


trait TraitThemeSet
{
    protected function setTheme()
    {
        $themeName = $this->getView()->setting("site.theme") ?: "basic";

        $theme = \Yii::$app->getView()->theme;
        $theme->setBasePath("@themes/" . $themeName);
        $theme->pathMap = [
            '@application/views'   => sprintf('@themes/%s/views', $themeName),
            '@application/modules' => sprintf('@themes/%s/views/modules', $themeName),
        ];
    }
}