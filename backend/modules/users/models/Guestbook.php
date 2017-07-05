<?php

namespace app\modules\users\models;

use Yii;

class Guestbook extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%guestbook}}';
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', '用户名'),
            'phone' => Yii::t('app', '电话'),
            'address' => Yii::t('app', '地址'),
            'content' => Yii::t('app', '内容'),
            'created_at' => Yii::t('app', '创建于'),
        ];
    }
}
