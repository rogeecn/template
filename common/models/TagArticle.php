<?php

namespace common\models;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tag_article".
 *
 * @property integer $id
 * @property integer $tag_id
 * @property integer $article_id
 */
class TagArticle extends \common\base\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tag_article';
    }

    public static function setArticleTags($articleID, $tagList) {
        $tagDataList      = self::getArticleTags($articleID);
        $currentTagIDList = ArrayHelper::getColumn($tagDataList, "id");

        $tagIDList = Tag::getIDListByTagName($tagList);

        $removeTags = array_diff($currentTagIDList, $tagIDList);
        $newTags    = array_diff($tagIDList, $currentTagIDList);

        if (!empty($removeTags)) {
            TagArticle::deleteAll(['article_id' => $articleID, 'tag_id' => $removeTags]);
            foreach ($removeTags as $removeTagID) {
                Tag::descTagReferenceCountByID($removeTagID);
            }
            return true;
        }

        if (!empty($newTags)) {
            foreach ($newTags as $newTag) {
                $tagModel = Tag::createTag($newTag);
                if ($tagModel->hasErrors()) {
                    continue;
                }

                $model             = new TagArticle();
                $model->tag_id     = $tagModel->primaryKey;
                $model->article_id = $articleID;
                $model->save();
            }
            return true;
        }

        return true;
    }

    public static function getArticleTags($articleID) {
        $tags = self::find()->with("tag")->where(['article_id' => $articleID])->all();

        $tagList = [];
        foreach ($tags as $tag) {
            $tags[] = [
                'name' => $tag->tag->name,
                'id'   => $tag->id,
            ];
        }

        return $tagList;
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['tag_id', 'article_id'], 'required'],
            [['tag_id', 'article_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id'         => 'ID',
            'tag_id'     => 'Tag ID',
            'article_id' => 'Article ID',
        ];
    }

    public function getTag() {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }
}
