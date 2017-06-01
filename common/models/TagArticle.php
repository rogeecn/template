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
    public static function tableName()
    {
        return 'tag_article';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_id', 'article_id'], 'required'],
            [['tag_id', 'article_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'tag_id'     => 'Tag ID',
            'article_id' => 'Article ID',
        ];
    }

    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }

    public static function setArticleTags($articleID, $tagList)
    {
        $tagDataList        = self::getArticleTags($articleID);
        $currentTagNameList = ArrayHelper::getColumn($tagDataList, "name");

        $tagList = array_unique($tagList);

        $removeTags = array_diff($currentTagNameList, $tagList);
        $newTags    = array_diff($tagList, $currentTagNameList);

        if (!empty($removeTags)) {
            $removeTagIDList = Tag::getIDListByTagName($removeTags);
            TagArticle::deleteAll(['article_id' => $articleID, 'tag_id' => $removeTagIDList]);
            foreach ($removeTagIDList as $removeTagID) {
                Tag::descTagReferenceCountByID($removeTagID);
            }
        }

        if (!empty($newTags)) {
            foreach ($newTags as $newTag) {
                $tagModel = Tag::getByTagName($newTag);
                if (!$tagModel) {
                    $tagModel = Tag::createTag($newTag);
                    if ($tagModel->hasErrors()) {
                        continue;
                    }
                } else {
                    $tagModel->incReferenceCount();
                }

                $model             = new TagArticle();
                $model->tag_id     = $tagModel->primaryKey;
                $model->article_id = $articleID;
                $model->save();
            }
        }

        return TRUE;
    }

    public static function getArticleTags($articleID)
    {
        $tags = self::find()->with("tag")->where(['article_id' => $articleID])->all();

        $tagList = [];
        foreach ($tags as $tag) {
            $tagList[] = [
                'name' => $tag->tag->name,
                'id'   => $tag->id,
            ];
        }

        return $tagList;
    }

    public static function getTagArticleIDList($tagID, $page = 1, $limit = 10)
    {
        $offset    = ($page - 1) * $limit;
        $tagIDList = self::find()->where(['tag_id' => $tagID])
                         ->limit($limit)
                         ->offset($offset)
                         ->orderBy(['id' => SORT_DESC])
                         ->all();
        $articleID = ArrayHelper::getColumn($tagIDList, "article_id");

        return $articleID;
    }

    public static function getTagArticleCount($tagID)
    {
        return self::find()->where(['tag_id' => $tagID])->count();
    }

    public static function removeArticle($articleID)
    {
        return self::deleteAll(['article_id' => $articleID]);
    }
}
