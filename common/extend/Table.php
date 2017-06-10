<?php
namespace common\extend;


use plugins\sortable\SortableAssets;
use yii\base\Widget;

class Table extends Widget
{
    public $colGroup     = [];
    public $columns      = [];
    public $dataProvider = [];
    public $options      = [];
    public $sortable     = false;
    public $orderInput   = 'input';
    public $showHeader   = true;

    public function run()
    {
        $html = "\n";
        if (!empty($this->colGroup)) {
            $html .= $this->renderTableColGroup();
        }

        if ($this->showHeader) {
            $html .= $this->renderTableHead() . "\n";
        }
        $html .= $this->renderTableBody() . "\n";


        if (empty($this->options['class'])) {
            $this->options['class'] = 'table table-bordered table-stripped';
        }

        if (!isset($this->options['id'])) {
            $this->options['id'] = self::getId();
        }

        if ($this->sortable) {
            SortableAssets::register($this->getView());
            $sortableJS          = <<<_JS_
// Sortable rows
$('#{$this->options['id']}').sortable({
  handle: 'i.drag-handle',
  containerSelector: 'table',
  itemPath: '> tbody',
  itemSelector: 'tr',
  placeholder: '<tr class="placeholder"></tr>',
  onDrop: function(item,container,_super){
    $(item).closest("table").find("tbody tr").each(function(index,item){
        $(item).find("{$this->orderInput}").val(index)
    });
  }
});
_JS_;
            $sortablePlaceholder = <<<_CSS_
i.drag-handle{
    cursor: move;
}
tr.placeholder{
    background: lightyellow;
    height: 5px;
}
_CSS_;


            $this->getView()->registerJs($sortableJS);
            $this->getView()->registerCss($sortablePlaceholder);
        }

        return "\n" . Html::tag('table', $html, $this->options);
    }

    private function renderTableColGroup()
    {
        $cols = [];
        foreach ($this->colGroup as $colGroup) {
            if (!empty($colGroup)) {
                $cols[] = Html::tag("col", "", ['width' => $colGroup]);
                continue;
            }
            $cols[] = Html::tag("col", "");
        }

        return Html::tag("colgroup", implode("\n", $cols));
    }

    private function renderTableHead()
    {
        $cols = [];
        foreach ($this->columns as $column) {
            list($key, $label) = $this->getKeyAndLabel($column);

            if (is_array($column)) {
                if (!isset($column['options'])) {
                    $column['options'] = [];
                }
                $column['options']['data-key'] = $key;
                $cols[]                        = Html::tag("td", $label, $column['options']);
                continue;
            }
            $cols[] = Html::tag("td", $label);
        }

        return Html::tag("thead", Html::tag("tr", implode("\n", $cols)));
    }

    private function renderTableBody()
    {
        $rows = [];
        foreach ($this->dataProvider as $items) {
            $cols = [];
            foreach ($this->columns as $column) {
                list($key, $label) = $this->getKeyAndLabel($column);

                $value = "";
                if (isset($column['value'])) {
                    $value = $column['value']($items);
                } elseif (!empty($key)) {
                    $value = $items[$key];
                }
                $cols[] = Html::tag("td", $value);
            }
            $rows[] = Html::tag("tr", implode("\n", $cols));
        }

        $tableBody = Html::tag("tbody", implode("\n", $rows));

        return $tableBody;
    }

    private function getKeyAndLabel($column)
    {
        if (is_string($column)) {
            $columnData = explode(":", $column);
            $key        = $label = "";
            if (count($columnData) == 1) {
                $key   = $column;
                $label = ucfirst($column);
            } else {
                list($key, $label) = $columnData;
            }

            return [$key, $label];
        }

        if (isset($column['label'])) {
            if (isset($column['key'])) {
                return [$column['key'], $column['label']];
            }

            return [null, $column['label']];
        }

        if (isset($column['key'])) {
            return [$column['key'], ucfirst($column['key'])];
        }

        return [null, null];
    }
}