<?php

namespace application\modules\test;

/**
 * tag module definition class
 */
class Module extends \common\extend\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'application\modules\test\controllers';

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();

        // custom initialization code goes here
    }
}
