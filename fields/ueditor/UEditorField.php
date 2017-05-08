<?php
namespace fields\ueditor;


use common\base\Field;
use common\base\IField;

class UEditorField extends Field implements IField
{
    public function getInfo() {
        return [
            'name' => "UEditor 富文本编辑器",
        ];
    }
}