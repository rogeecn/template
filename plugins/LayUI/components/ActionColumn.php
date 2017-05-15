<?php
namespace plugins\LayUI\components;


class ActionColumn extends \yii\grid\ActionColumn
{
    public $template = '{update} {delete}';
    protected function initDefaultButtons() {
        $this->initDefaultButton('update', '编辑');
        $this->initDefaultButton('delete', '删除', [
            'data-confirm' => '确认删除?',
            'data-method'  => 'post',
            'style'        => 'color: red;',
        ]);
    }

    protected function initDefaultButton($name, $iconName, $additionalOptions = []) {
        if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
            $this->buttons[$name] = function ($url, $model, $key) use ($name, $iconName, $additionalOptions) {
                $options = array_merge([
                    'data-pjax' => '0',
                ], $additionalOptions, $this->buttonOptions);
                return Html::a(sprintf("[%s]", $iconName), $url, $options);
            };
        }
    }
}