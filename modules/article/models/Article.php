<?php

namespace modules\article\models;


use common\extend\UserInfo;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string  $title
 * @property integer $category_id
 * @property integer $user_id
 * @property integer $type
 * @property integer $index_show
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Article extends \common\base\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'article';
    }

    public function formName()
    {
        return "";
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title', 'type','category_id'], 'required'],
            [['user_id', 'category_id','status', 'type', 'index_show', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 240],
            [['status'], 'default', 'value' => self::ST_ENABLE],
            ['category_id', 'default', 'value' => 0],
            [['index_show'], 'default', 'value' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id'         => 'ID',
            'title'      => 'Title',
            'user_id'    => 'User ID',
            'category_id'    => 'Category',
            'type'       => 'Type',
            'index_show' => 'Index Show',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function beforeSave($insert)
    {
        $this->user_id = UserInfo::getID();
        return parent::beforeSave($insert);
    }
}
