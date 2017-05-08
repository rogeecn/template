<?php

namespace modules\article\models;

/**
 * This is the model class for table "article_type".
 *
 * @property integer $id
 * @property string  $name
 * @property string  $alias
 * @property string  $description
 * @property integer $order
 */
class ArticleType extends \common\base\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'article_type';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'alias', 'description'], 'required'],
            [['order'], 'integer'],
            ['alias', 'unique'],
            [['name', 'alias', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id'          => 'ID',
            'name'        => 'Name',
            'alias'       => 'Alias',
            'description' => 'Description',
            'order'       => 'Order',
        ];
    }

}
