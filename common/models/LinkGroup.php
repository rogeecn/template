<?php

namespace common\models;

use common\base\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "link_group".
 *
 * @property integer $id
 * @property string $alias
 * @property string $image
 * @property string $title
 * @property integer $display
 * @property integer $group_id
 * @property string $value
 * @property string $type
 * @property integer $order
 */
class LinkGroup extends ActiveRecord
{

    const DISPLAY_GROUP  = "0";
    const DISPLAY_LINK = "1";

    const TYPE_FRIEND_LINK        = "friend_link";
    const TYPE_ARTICLE          = "article";
    const TYPE_PAGE          = "page";

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'link_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias','title', 'display'], 'required'],
            [['display', 'group_id','order'], 'integer'],
            [['alias','image', 'title'], 'string', 'max' => 240],
            [['value'], 'string', 'max' => 1200],
            [['type'], 'string', 'max' => 100],
            [['order'], 'default', 'value' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alias' => 'Alias',
            'title' => 'Title',
            'display' => 'Display',
            'group_id' => 'Group ID',
            'value' => 'Value',
            'type' => 'Type',
        ];
    }

    public static function getTypeList() {
        return [
            self::TYPE_FRIEND_LINK        => "友情链接",
            self::TYPE_ARTICLE          => "文章",
            self::TYPE_PAGE          => "页面",
        ];
    }

    public static function getGroupList($asArray = false) {
        $groupList = self::find()->where(['display' => LinkGroup::DISPLAY_GROUP])->orderBy(['order'=>SORT_ASC])->all();
        if (!$asArray) {
            return $groupList;
        }

        return ArrayHelper::map($groupList, "id", "title");
    }

    public static function getGroupLinkList($groupId) {
        $condition = [
            'group_id' => $groupId,
            'display'  => self::DISPLAY_LINK,
        ];

        /** @var LinkGroup[] $columnModels */
        $columnModels = LinkGroup::find()->where($condition)->orderBy(['order'=>SORT_ASC])->all();

        $retList = [];
        foreach ($columnModels as $columnModel) {
            $tmpData = $columnModel->toArray();
            $tmpData['formName'] = sprintf("group[%d][%s]",$groupId,$columnModel['alias']);
            $tmpData['pre_configure'] = explode("\n", $columnModel['pre_configure']);;
            $retList[] = $tmpData;
        }

        return $retList;
    }

    public function createColumn() {
        $this->display = self::DISPLAY_LINK;
        return $this->save();
    }

    public function createGroup() {
        $this->display = self::DISPLAY_GROUP;
        return $this->save();
    }

    public static function flatSettings()
    {
        $groups = self::getGroupList(true);

        $data =[];
        foreach ($groups as $groupID=>$groupAlias){
            $columnList = self::getGroupLinkList($groupID);
            foreach ($columnList as $columnData){
                $columnKey = sprintf("%s.%s",$groupAlias,$columnData['alias']);
                $data[$columnKey] = $columnData['value'];
            }
        }
        return $data;
    }
}
