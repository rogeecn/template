<?php
namespace common\extend;


class Module extends \yii\base\Module
{
    public function init() {
        parent::init();

        /** @var Theme $theme */
        $theme = \Yii::$app->getView()->theme;
        $this->setViewPath($theme->getBasePath() . '/modules/' . $this->getUniqueId());
    }
}