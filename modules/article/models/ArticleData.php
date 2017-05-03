<?php

namespace modules\article\models;

/**
 * This is the model class for table "article_data".
 *
 * @property integer $id
 * @property string  $show_image
 * @property string  $description
 * @property string  $content
 */
class ArticleData extends \common\base\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'article_data';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['content'], 'required'],
            [['content'], 'string'],
            [['show_image'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 1200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id'          => 'ID',
            'show_image'  => 'Show Image',
            'description' => 'Description',
            'content'     => 'Content',
        ];
    }
}
