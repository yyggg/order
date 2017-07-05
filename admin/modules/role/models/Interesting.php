<?php

namespace app\modules\interesting\models;

use Yii;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 * @property string $content
 * @property integer $created_at
 */
class Interesting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%interesting}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'created_at'], 'integer'],
            [['content','list_img'], 'string'],
            [['title'], 'string', 'max' => 150],
            ['created_at','default','value'=>time()]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', '分类'),
            'title' => Yii::t('app', '标题'),
            'list_img' => Yii::t('app', '图片'),
            'content' => Yii::t('app', '内容'),
            'created_at' => Yii::t('app', '创建于'),
        ];
    }
}
