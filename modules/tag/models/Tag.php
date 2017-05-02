<?php

namespace modules\tag\models;

use common\base\ActiveRecord;
use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $name
 * @property integer $reference_count
 */
class Tag extends \common\base\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['reference_count'], 'integer'],
            [['name'], 'string', 'max' => 120],
            [['name'], 'unique'],
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
            'reference_count' => 'Reference Count',
        ];
    }

    public static function getIDListByTagName($tagList)
    {
        $tags = self::find()->select("id")->where(['name'=>$tagList])->all();

        $idList = [];
        foreach ($tags as $tag){
            $idList[] = $tag->primaryKey;
        }
        return $idList;
    }

    /**
     * @param $tagName
     * @return null|Tag|ActiveRecord|array
     */
    public static function getByTagName($tagName)
    {
        return self::find()->where(['name'=>$tagName])->one();
    }

    public static function createTag($tagName)
    {
        $model = new Tag();
        $model->name = $tagName;
        $model->reference_count = 1;
        $model->save();
        return $model;
    }

    public static function incTagReferenceCountByName($tagName)
    {
        $tag = self::getByTagName($tagName);
        if (!$tag){
            $model = self::createTag($tagName);
            if ($model->hasErrors()){
                return false;
            }
            return true;
        }

        return $tag->incReferenceCount();
    }

    public static function descTagReferenceCountByName($tagName)
    {
        $tag = self::getByTagName($tagName);
        if (!$tag){
            $model = self::createTag($tagName);
            if ($model->hasErrors()){
                return false;
            }
            return true;
        }
        return $tag->descReferenceCount();

    }

    public static function incTagReferenceCountByID($tagID)
    {
        $tag = self::findOne($tagID);
        if (!$tag){
            return false;
        }
        return $tag->incReferenceCount();
    }

    public static function descTagReferenceCountByID($tagID)
    {
        $tag = self::findOne($tagID);
        if (!$tag){
            return false;
        }
        return $tag->descReferenceCount();
    }

    public function incReferenceCount()
    {
        $this->reference_count +=1;
        if ($this->reference_count <=0){
            $this->reference_count = 0;
        }

        return $this->save();
    }


    public function descReferenceCount()
    {
        $this->reference_count -=1;
        if ($this->reference_count <=0){
            $this->reference_count = 0;
        }

        return $this->save();
    }
}
