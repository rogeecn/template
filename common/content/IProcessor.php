<?php
/**
 * Created by PhpStorm.
 * User: yanghao
 * Date: 2017/6/21
 * Time: 16:43
 */

namespace common\content;


interface IProcessor
{
    public function processContent($content);

    public function getPublishData($htmlData);
}
