<?php
namespace common\util;


use common\base\Widget;

class DataProvider extends Widget
{
    public static function widget($config = [])
    {
        try {
            /* @var $widget Widget */
            $config['class'] = get_called_class();
            $widget          = \Yii::createObject($config);
            $out             = '';
            if ($widget->beforeRun()) {
                $result = $widget->run();
                $out    = $widget->afterRun($result);
            }
        } catch (\Exception $e) {
            throw $e;
        }

        return $out;
    }

    public function run()
    {
        return $this->getData();
    }
}