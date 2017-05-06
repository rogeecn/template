<?php
namespace modules\category\models;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string  $name
 * @property string  $alias
 * @property string  $path
 * @property integer $pid
 * @property integer $order
 */
class Category extends \common\base\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['pid', 'order'], 'integer'],
            [['name', 'alias'], 'string', 'max' => 120],
            [['path'], 'string', 'max' => 1200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id'    => 'ID',
            'name'  => 'Name',
            'alias' => 'Alias',
            'path'  => 'Path',
            'pid'   => 'Pid',
        ];
    }

    private static function generateTree($items) {
        foreach ($items as $item)
            $items[$item['pid']]['children'][$item['id']] = &$items[$item['id']];
        return isset($items[0]['children']) ? $items[0]['children'] : array();
    }

    public static function getIndentList() {
        $list = self::getList();
        return self::generateTree($list);
    }

    public static function getList() {
        $dataList = Category::find()->orderBy(['pid' => SORT_ASC, 'order' => SORT_ASC])->asArray()->all();

        $keyDataList = [];
        foreach ($dataList as $data) {
            $keyDataList[$data['id']] = $data;
        }
        return $keyDataList;
    }

    private static function formatFlatIndentList($list, &$items = [], $level = 0) {
        foreach ($list as $item) {
            $treeLevel = $level;
            $prefix = "";
            if ($treeLevel > 0 ){
                $prefix = str_repeat("- ", $treeLevel*2);
            }
            $items[$item['id']] =  $prefix. $item['name'];
            if (isset($item['children']) && is_array($item['children'])) {
                self::formatFlatIndentList($item['children'], $items, ++$treeLevel);
            }
        }
    }

    public function getFlatIndentList($showRoot = false) {
        $list = self::getIndentList();

        $items = [];
        $level = 0;
        if ($showRoot){
            $level = 1;
            $items[] ='根分类';
        }
        self::formatFlatIndentList($list, $items, $level);
        return $items;
    }
}
