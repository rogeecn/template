<?php
namespace LayUI\components;


use yii\base\Widget;

class Table extends Widget
{
    public $colGroup=[];
    public $columns=[];
    public $dataList = [];

    public function run()
    {
        $html = "";
        if (!empty($this->colGroup)){
            $html .= $this->renderTableColGroup();
        }

        $html.=$this->renderTableHead();
        $html.=$this->renderTableBody();
        return $html;
    }

    private function renderTableColGroup()
    {
        $html = "";
        foreach ($this->colGroup as $colGroup){
            if (isset($colGroup['width'])){
                $html .= Html::tag("col","",['width'=>$colGroup]);
            }
            $html .= Html::tag("col","");
        }

        $html = Html::tag("colgroup",$html);
        return $html;
    }

    private function renderTableHead()
    {
        $tableHead = "";
        foreach ($this->columns as $column){
            list($key,$label) = $this->getKeyAndLabel($column);
            $tableHead .= Html::beginTag("tr");
            $tableHead .= Html::tag("td",$label,['data-key'=>$key]);
            $tableHead .= Html::endTag("tr");
        }

        $tableHead = Html::tag("thead",$tableHead);
        return $tableHead;
    }

    private function renderTableBody()
    {
        $tableBody = "";
        foreach ($this->dataList as $items){
            $tableBody .= Html::beginTag("tr");
            foreach ($this->columns as $column){
                list($key,$label) = $this->getKeyAndLabel($column);
                $tableBody .= Html::tag("td",$items[$key]);
            }
            $tableBody .= Html::endTag("tr");
        }

        $tableBody = Html::tag("tbody",$tableBody);
        return $tableBody;
    }

    private function getKeyAndLabel($column)
    {
        $columnData = explode(":",$column);

        $key = $label = "";
        if (count($columnData) == 1){
            $key = $column;
            $label = ucfirst($column);
        }else{
            list($key,$label) = $columnData;
        }
        return [$key,$label];
    }
}