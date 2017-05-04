<?php
namespace LayUI\components;

use LayUI\LayUIAssets;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

/**
 * Tabs renders a Tab bootstrap javascript component.
 *
 * For example:
 *
 * ```php
 * echo Tabs::widget([
 *     'items' => [
 *         [
 *             'label' => 'One',
 *             'content' => 'Anim pariatur cliche...',
 *             'active' => true
 *         ],
 *         [
 *             'label' => 'Two',
 *             'content' => 'Anim pariatur cliche...',
 *             'headerOptions' => [...],
 *             'options' => ['id' => 'myveryownID'],
 *         ],
 *         [
 *             'label' => 'Example',
 *             'url' => 'http://www.example.com',
 *         ],
 *         [
 *             'label' => 'Dropdown',
 *             'items' => [
 *                  [
 *                      'label' => 'DropdownA',
 *                      'content' => 'DropdownA, Anim pariatur cliche...',
 *                  ],
 *                  [
 *                      'label' => 'DropdownB',
 *                      'content' => 'DropdownB, Anim pariatur cliche...',
 *                  ],
 *             ],
 *         ],
 *     ],
 * ]);
 * ```
 *
 * @see http://getbootstrap.com/javascript/#tabs
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @since 2.0
 */
class Tabs extends Widget
{


    public $items = [];

    //  lay-allowClose="true"
    public $allowClose = false;

    public $options = [];

    public $itemOptions = [];

    public $headerOptions = [];

    public $linkOptions = [];

    public $encodeLabels = true;

    // layui-tab layui-tab-brief  layui-tab-card
    public $navType = '';

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, ['layui-tab', $this->navType]);
        Html::addCssClass($this->headerOptions, ['layui-tab-title']);
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        LayUIAssets::register($this->getView());
        return $this->renderItems();
    }

    /**
     * Renders tab items as specified on [[items]].
     * @return string the rendering result.
     * @throws InvalidConfigException.
     */
    protected function renderItems()
    {
        $headers = [];
        $panes = [];

        if (!$this->hasActiveTab() && !empty($this->items)) {
            $this->items[0]['active'] = true;
        }

        foreach ($this->items as $n => $item) {
            if (!array_key_exists('label', $item)) {
                throw new InvalidConfigException("The 'label' option is required.");
            }

            $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
            $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];

            $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));
            $options['id'] = ArrayHelper::getValue($options, 'id', $this->options['id']?:"w" . '-tab' . $n);

            Html::addCssClass($options, 'layui-tab-item');
            $headerOptions = [];
            if (ArrayHelper::remove($item, 'active')) {
                Html::addCssClass($options, 'layui-show');
                Html::addCssClass($headerOptions, 'layui-this');
            }

            $tag = ArrayHelper::remove($options, 'tag', 'div');
            $panes[] = Html::tag($tag, isset($item['content']) ? $item['content'] : '', $options);
            $headers[] = Html::tag('li', $label, $headerOptions);
        }

        $header = Html::tag('ul', implode("\n", $headers),$this->headerOptions);
        $body = Html::tag('div', implode("\n", $panes), ['class' => 'layui-tab-content']);
        return Html::tag("div", $header. "\n" .$body ,$this->options);
    }

    protected function hasActiveTab()
    {
        foreach ($this->items as $item) {
            if (isset($item['active']) && $item['active'] === true) {
                return true;
            }
        }

        return false;
    }
}
