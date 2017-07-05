<?php

namespace app\modules\menus\models;

use Yii;

/**
 * This is the model class for table "{{%menus}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent
 * @property string $route
 * @property integer $sort
 */
class Menus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menus}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            [['parent', 'sort'], 'integer'],
            [['parent', 'sort'], 'default','value'=>0],
            ['route', 'default','value'=>'#'],
            [['name', 'route'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', '名称'),
            'parent' => Yii::t('app', '父级'),
            'route' => Yii::t('app', '路由'),
            'sort' => Yii::t('app', '排序'),
        ];
    }
}
