<?php

namespace modules\article\models;

/**
 * This is the model class for table "sticky_article".
 *
 * @property integer $id
 * @property integer $article_id
 * @property integer $order
 * @property integer $category
 */
class StickyArticle extends \common\base\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'sticky_article';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['article_id'], 'required'],
            [['article_id', 'order', 'category'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id'         => 'ID',
            'article_id' => 'Article ID',
            'order'      => 'Order',
            'category'   => 'Category',
        ];
    }
}
