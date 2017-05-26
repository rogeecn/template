<?php
namespace application\controllers;

use application\base\WebController;

class TagController extends WebController
{
    public function actionIndex($name)
    {
        return $this->render("/tag", [
            'page-type' => 'tag',
        ]);
    }
}
