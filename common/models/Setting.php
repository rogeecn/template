<?php

namespace common\models;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "setting".
 *
 * @property integer $id
 * @property string  $alias
 * @property string  $title
 * @property integer $display
 * @property integer $group_id
 * @property string  $value
 * @property string  $hint
 * @property string  $type
 * @property string  $pre_configure
 * @property integer $order
 */
class Setting extends \common\base\ActiveRecord
{
    const DISPLAY_GROUP  = "0";
    const DISPLAY_COLUMN = "1";

    const TYPE_STRING        = "string";
    const TYPE_TEXT          = "text";
    const TYPE_SINGLE_SELECT = "single_select";
    const TYPE_MULTI_SELECT  = "multi_select";
    const TYPE_HTML          = "html";

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias', 'title', 'display'], 'required'],
            [['display', 'order', 'group_id'], 'integer'],
            [['alias', 'title'], 'string', 'max' => 240],
            [['value', 'hint', 'pre_configure'], 'string', 'max' => 1200],
            [['type'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'alias'         => 'Alias',
            'title'         => 'Title',
            'display'       => 'Display',
            'group_id'      => 'Group ID',
            'value'         => 'Value',
            'hint'          => 'Hint',
            'type'          => 'Type',
            'pre_configure' => 'Pre Configure',
        ];
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting';
    }


    public static function getTypeList()
    {
        return [
            self::TYPE_STRING        => "字符串",
            self::TYPE_TEXT          => "文本",
            self::TYPE_HTML          => "HTML文本",
            self::TYPE_SINGLE_SELECT => "单选下拉",
            self::TYPE_MULTI_SELECT  => "多选下拉",
        ];
    }

    public static function getGroupList($asArray = FALSE)
    {
        $groupList = Setting::find()->where(['display' => Setting::DISPLAY_GROUP])->orderBy(['order' => SORT_ASC])->all();
        if (!$asArray) {
            return $groupList;
        }

        return ArrayHelper::map($groupList, "id", "title");
    }

    public static function getGroupColumnList($groupId)
    {
        $condition = [
            'group_id' => $groupId,
            'display'  => Setting::DISPLAY_COLUMN,
        ];

        /** @var Setting[] $columnModels */
        $columnModels = Setting::find()->where($condition)->orderBy(['order' => SORT_ASC])->all();

        $retList = [];
        foreach ($columnModels as $columnModel) {
            $tmpData = $columnModel->toArray();

            if ($tmpData['type'] == self::TYPE_MULTI_SELECT) {
                $tmpData['value'] = explode(",", $tmpData['value']);
            }
            $tmpData['formName']      = sprintf("group[%d][%s]", $groupId, $columnModel['alias']);
            $tmpData['pre_configure'] = explode("\n", $columnModel['pre_configure']);;
            $retList[] = $tmpData;
        }

        return $retList;
    }

    public function createColumn()
    {
        $this->display = self::DISPLAY_COLUMN;

        return $this->save();
    }

    public function createGroup()
    {
        $this->display = self::DISPLAY_GROUP;

        return $this->save();
    }

    public static function flatSettings()
    {
        $groups = self::getGroupList();

        $data = [];
        foreach ($groups as $groupModel) {
            $columnList = self::getGroupColumnList($groupModel->id);
            foreach ($columnList as $columnData) {
                $columnKey = sprintf("%s.%s", $groupModel->alias, $columnData['alias']);
                /*switch ($columnData['type']){
                    case self::TYPE_STRING:
                    case self::TYPE_HTML:
                    case self::TYPE_TEXT:
                        $value = $columnData['value'];
                        break;
                    case self::TYPE_SINGLE_SELECT:
                        $value = $columnData['pre_configure'][$columnData['value']];
                        break;
                    case self::TYPE_MULTI_SELECT:
                        $keys = explode(",",$columnData['value']);

                        $value = [];
                        foreach ($keys as $key){
                            $value[] = $columnData['pre_configure'][$key];
                        }
                        break;
                }

                $data[$columnKey] = $value;
                */
                $data[$columnKey] = $columnData['value'];
            }
        }

        return $data;
    }
}
