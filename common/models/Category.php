<?php
namespace common\models;

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
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alias'], 'required'],
            [['pid', 'order'], 'integer'],
            [['name', 'alias'], 'string', 'max' => 120],
            [['path'], 'string', 'max' => 1200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'    => 'ID',
            'name'  => 'Name',
            'alias' => 'Alias',
            'path'  => 'Path',
            'pid'   => 'Pid',
        ];
    }

    private static function generateTree($items)
    {
        foreach ($items as $item)
            $items[$item['pid']]['children'][$item['id']] = &$items[$item['id']];

        return isset($items[0]['children']) ? $items[0]['children'] : [];
    }

    public static function getIndentList()
    {
        $list = self::getList();

        return self::generateTree($list);
    }

    public static function getList()
    {
        $dataList = Category::find()->orderBy(['pid' => SORT_ASC, 'order' => SORT_ASC])->asArray()->all();

        $keyDataList = [];
        foreach ($dataList as $data) {
            $keyDataList[$data['id']] = $data;
        }

        return $keyDataList;
    }

    private static function formatFlatIndentList($list, &$items = [], $level = 0)
    {
        foreach ($list as $item) {
            $treeLevel = $level;
            $prefix    = "";
            if ($treeLevel > 0) {
                $prefix = str_repeat("- ", $treeLevel * 2);
            }
            $items[$item['id']] = $prefix . $item['name'];
            if (isset($item['children']) && is_array($item['children'])) {
                self::formatFlatIndentList($item['children'], $items, ++$treeLevel);
            }
        }
    }

    public static function getFlatIndentList($showRoot = FALSE)
    {
        $list = self::getIndentList();

        $items = [];
        $level = 0;
        if ($showRoot) {
            $level   = 1;
            $items[] = '根分类';
        }
        self::formatFlatIndentList($list, $items, $level);

        return $items;
    }

    public static function getName($categoryID)
    {
        return self::findOne($categoryID)->name;
    }

    public static function breadCrumb($catID)
    {
        $list = self::getList();

        $breadcrumbs = [];
        while ($catID > 0) {
            $breadcrumbs[] = $list[$catID];
            $catID         = $list[$catID]['pid'];
        }

        return array_reverse($breadcrumbs);
    }

    public static function getSubTree($id, $showFlat = FALSE)
    {
        $list = self::getIndentList();

        $list = self::getSubTreeItems($id, $list);
        if (!$showFlat) {
            return $list;
        }

        $items = [];
        self::formatFlatIndentList([$list], $items);

        return $items;
    }

    private static function getSubTreeItems($id, $list)
    {
        foreach ($list as $item) {
            if ($item['id'] == $id) {
                return $item;
            }

            if (isset($item['children']) && is_array($item['children'])) {
                $ret = self::getSubTreeItems($id, $item['children']);
                if ($ret == FALSE) {
                    continue;
                }

                return $ret;
            }
        }

        return FALSE;
    }

    public static function getByAlias($alias)
    {
        return self::find()->where(['alias' => $alias])->one();
    }
}
