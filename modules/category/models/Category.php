<?php
namespace modules\category\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property string $path
 * @property integer $pid
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
            [['name'], 'required'],
            [['pid'], 'integer'],
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
            'id' => 'ID',
            'name' => 'Name',
            'alias' => 'Alias',
            'path' => 'Path',
            'pid' => 'Pid',
        ];
    }

    public static function getIndentList() {
       return self::getList() ;
    }

    private static function getList() {

    }
}
