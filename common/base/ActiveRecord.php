<?php
namespace common\base;


class ActiveRecord extends \yii\db\ActiveRecord
{
    const ST_ENABLE = 0;
    const ST_DISABLE = 1;
    const ST_REMOVED = 2;
}