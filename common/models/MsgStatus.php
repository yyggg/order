<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;


class MsgStatus extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%msg_status}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['userid', 'integer'],
            ['status', 'default', 'value' => 0],
        ];
    }

}
