<?php

namespace modules\article\models;

use yii\helpers\StringHelper;

/**
 * This is the model class for table "article_field".
 *
 * @property integer $id
 * @property integer $type_id
 * @property string  $label
 * @property string  $name
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
    public static function tableName() {
        return 'article_field';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['type_id', 'label', 'name', 'options', 'description', 'class'], 'required'],
            [['type_id', 'order'], 'integer'],
            [['options'], 'string'],
            [['label', 'name', 'description', 'class'], 'string', 'max' => 255],
            ['order', 'default', 'value' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id'          => 'ID',
            'type_id'     => 'Type ID',
            'label'       => 'Label',
            'name'        => 'Name',
            'options'     => 'Options',
            'description' => 'Description',
            'class'       => 'Class',
            'order'       => 'Order',
        ];
    }

    public static function fieldClasses() {
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
            echo $path."<hr/>";

            $subHandle = opendir($path);
            if ($subHandle === false) {
                continue;
            }
            while (($subFile = readdir($subHandle)) !== false) {
                echo $subFile."<hr/>";
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

    public static function fieldList() {
        $fieldDirs = self::fieldClasses();
        return $fieldDirs;

        $list = [];
        foreach ($fieldDirs as $dir) {

        }
    }
}