<?php
namespace console\controllers;


use common\content\Process;
use console\base\ConsoleController;

class TestController extends ConsoleController
{
    public function actionIndex()
    {
        $url     = "http://www.cnblogs.com/cnlian/p/5765871.html";
        $process = new Process($url, 19);
        $process->publish();
    }
}