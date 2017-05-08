<?php
namespace LayUI\components;


use plugins\sortable\SortableAssets;
use yii\grid\Column;

class DndColumn extends Column
{
    public $header = "#";
    public $input  = "input";


    public function init() {
        parent::init();

        SortableAssets::register($this->grid->getView());
        $sortableJS          = <<<_JS_
// Sortable rows
$('#{$this->grid->getId()} table').sortable({
  handle: 'i.drag-handle',
  containerSelector: 'table',
  itemPath: '> tbody',
  itemSelector: 'tr',
  placeholder: '<tr class="placeholder"></tr>',
  onDrop: function(item,container,_super){
    $(item).closest("table").find("tbody tr").each(function(index,item){
        $(item).find("{$this->input}").val(index)
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


        $this->grid->getView()->registerJs($sortableJS);
        $this->grid->getView()->registerCss($sortablePlaceholder);
    }
}