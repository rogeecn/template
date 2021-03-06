<?php

namespace common\models;

use common\base\Field;
use yii\helpers\StringHelper;

/**
 * This is the model class for table "article_field".
 *
 * @property integer $id
 * @property integer $type_id
 * @property string  $label
 * @property string  $name
 * @property string  $table
 * @property string  $options
 * @property string  $description
 * @property string  $class
 * @property integer $order
 */
class ArticleField extends \common\base\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'table', 'label', 'name', 'description', 'class'], 'required'],
            [['type_id', 'order'], 'integer'],
            [['options'], 'string'],
            [['label', 'name', 'table', 'description', 'class'], 'string', 'max' => 255],
            ['order', 'default', 'value' => 0],
            ['options', 'default', 'value' => '[]'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'type_id'     => 'Type ID',
            'label'       => 'Label',
            'name'        => 'Name',
            'table'       => 'Table',
            'options'     => 'Options',
            'description' => 'Description',
            'class'       => 'Class',
            'order'       => 'Order',
        ];
    }

    public static function fieldClasses()
    {
        $fieldPath = \Yii::getAlias("@fields");
        if (!is_dir($fieldPath)) {
            return [];
        }
        $dir = rtrim($fieldPath, DIRECTORY_SEPARATOR);

        $list   = [];
        $handle = opendir($dir);
        if ($handle === false) {
            return [];
        }

        while (($file = readdir($handle)) !== false) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            $path = $dir . DIRECTORY_SEPARATOR . $file;
            if (!is_dir($path)) {
                continue;
            }

            $subHandle = opendir($path);
            if ($subHandle === false) {
                continue;
            }
            while (($subFile = readdir($subHandle)) !== false) {
                if ($subFile === '.' || $subFile === '..') {
                    continue;
                }

                if (StringHelper::endsWith($subFile, "Field.php", true)) {
                    $list[] = sprintf('fields\%s\%s', $file, substr($subFile, 0, -4));
                }
            }
            closedir($subHandle);

        }
        closedir($handle);

        return $list;
    }

    public static function fieldList()
    {
        $fieldClasses = self::fieldClasses();

        $fields = [];
        foreach ($fieldClasses as $classPath) {
            $fields[] = self::getFieldClassInfo($classPath);
        }

        return $fields;
    }

    public static function getFieldClassInfo($fieldClass)
    {
        return $fieldClass::field([
            'action' => Field::ACTION_INFO,
        ]);
    }

    public static function getTypeFieldList($type)
    {
        $list = self::find()->where(['type_id' => $type])->orderBy(['order' => SORT_ASC])->asArray()->all();
        foreach ($list as &$item) {
            $item['label']   = json_decode($item['label'], true) ?: [];
            $item['options'] = json_decode($item['options'], true) ?: [];
        }

        return $list;
    }

    public static function getTableList()
    {
        $tables = \Yii::$app->getDb()->getSchema()->getTableNames();

        return array_combine($tables, $tables);
    }

    public function afterFind()
    {
        $this->label   = json_decode($this->label, true) ?: [];
        $this->options = json_decode($this->options, true) ?: [];
    }
}
