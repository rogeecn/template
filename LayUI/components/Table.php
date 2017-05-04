<?php
namespace LayUI\components;


use LayUI\LayUIAssets;
use yii\base\Widget;

class Table extends Widget
{
    public $colGroup = [];
    public $columns  = [];
    public $dataProvider = [];
    public $options  = [];

    public function run() {
        $html = "\n";
        if (!empty($this->colGroup)) {
            $html .= $this->renderTableColGroup();
        }

        $html .= $this->renderTableHead()."\n";
        $html .= $this->renderTableBody()."\n";


        if (empty($this->options['class'])) {
            $this->options['class'] = 'layui-table ';
        }

        LayUIAssets::register($this->getView());
        return "\n".Html::tag('table', $html, $this->options);
    }

    private function renderTableColGroup() {
        $cols = [];
        foreach ($this->colGroup as $colGroup) {
            if (isset($colGroup['width'])) {
                $cols[] = Html::tag("col", "", ['width' => $colGroup]);
            }
            $cols[] = Html::tag("col", "");
        }

        return Html::tag("colgroup", implode("\n",$cols));
    }

    private function renderTableHead() {
        $cols=[];
        foreach ($this->columns as $column) {
            list($key, $label) = $this->getKeyAndLabel($column);
            $cols[] = Html::tag("td", $label, ['data-key' => $key]);
        }

        return Html::tag("thead", Html::tag("tr",implode("\n",$cols)));
    }

    private function renderTableBody() {
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
            $rows[] = Html::tag("tr", implode("\n",$cols));
        }

        $tableBody = Html::tag("tbody", implode("\n",$rows));
        return $tableBody;
    }

    private function getKeyAndLabel($column) {
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

        return [$column['key'], ucfirst($column['key'])];
    }
}